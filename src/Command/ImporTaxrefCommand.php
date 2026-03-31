<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Taxref;

#[AsCommand(
    name: 'app:import-taxref',
    description: 'Add a short description for your command',
)]


class ImporTaxrefCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
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
	    $filePath = __DIR__ . '/../../TAXREFv18.csv';

	    if (!file_exists($filePath)) {
		$output->writeln('Fichier introuvable');
		return Command::FAILURE;
	    }

	    $handle = fopen($filePath, 'r');

	    // 🔹 Lire l'en-tête
	    $header = fgetcsv($handle, 0, "\t");

	    // Mapper les index des colonnes
	    $columns = array_flip($header);

	    $batchSize = 500;
	    $i = 0;

	    while (($row = fgetcsv($handle, 0, "\t")) !== false) {

		// 🔥 Filtre plantes uniquement
		if ($row[$columns['REGNE']] !== 'Plantae') {
		    continue;
		}

		$taxref = new Taxref();
		$taxref->setCdNom((int) $row[$columns['CD_NOM']]);
		$taxref->setCdRef((int) $row[$columns['CD_REF']]);
		$taxref->setNomCompletHtml($row[$columns['NOM_COMPLET_HTML']]);
		$taxref->setFamille($row[$columns['FAMILLE']]);
		/* $taxref->setRang($row[$columns['RANG']]); */

		$this->entityManager->persist($taxref);

		// ⚡ Batch pour performance
		if (($i % $batchSize) === 0) {
		    $this->entityManager->flush();
		    $this->entityManager->clear();
		}

		$i++;
	    }

	    fclose($handle);

	    $this->entityManager->flush();

	    $output->writeln("Import terminé : $i plantes");

	    return Command::SUCCESS;
	}
}
