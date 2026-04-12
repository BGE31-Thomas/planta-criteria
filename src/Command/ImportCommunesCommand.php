<?php

namespace App\Command;

use App\Entity\Commune;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import-communes',
    description: 'Import des communes depuis un fichier CSV',
)]

class ImportCommunesCommand extends Command
{
    protected static $defaultName = 'app:import-communes';

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = __DIR__ . '/../../019HexaSmal.csv';

	    if (!file_exists($filePath)) {
			$output->writeln('Fichier introuvable');
			return Command::FAILURE;
	    }

        $handle = fopen($filePath, 'r');

        if (!$handle) {
            $output->writeln('<error>Impossible d’ouvrir le fichier</error>');
            return Command::FAILURE;
        }

        
        $header = fgetcsv($handle, 0, ';');
        
        if (!$header) {
            $output->writeln('<error>CSV invalide</error>');
            return Command::FAILURE;
        }

        $columns = array_flip($header);

        if (!isset($columns['Nom_de_la_commune']) || !isset($columns['Code_postal'])) {
            $output->writeln('<error>Colonnes attendues : Nom_de_la_commune, Code_postal</error>');
            return Command::FAILURE;
        }

        $seen = [];
        $count = 0;
        $skipped = 0;

        while (($row = fgetcsv($handle, 0, ';')) !== false) {

            $nom = $row[$columns['Nom_de_la_commune']] ?? null;
            $codePostal = $row[$columns['Code_postal']] ?? null;

            if (!$nom || !$codePostal) {
                continue;
            }

            $nomNormalise = mb_strtolower(trim($nom));
            $nomNormalise = iconv('UTF-8', 'ASCII//TRANSLIT', $nomNormalise);
            $nomNormalise = preg_replace('/[^a-z0-9 ]/', '', $nomNormalise);

            $codePostal = trim($codePostal);

            $key = $nomNormalise . '-' . $codePostal;

            if (isset($seen[$key])) {
                $skipped++;
                continue;
            }

            $seen[$key] = true;

            $commune = new Commune();
            $commune->setNom($nom);
            $commune->setCodePostal($codePostal);

            $this->em->persist($commune);

            if (($count % 200) === 0) {
                $this->em->flush();
                $this->em->clear();
            }

            $count++;
        }

        fclose($handle);

        $this->em->flush();

        $output->writeln("<info>Import terminé</info>");
        $output->writeln("Importées : $count");
        $output->writeln("Doublons ignorés : $skipped");

        return Command::SUCCESS;
    }
}