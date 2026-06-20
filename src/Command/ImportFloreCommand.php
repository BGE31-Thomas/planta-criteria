<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Entity\Critere;
use App\Repository\TaxrefRepository;
use App\Repository\SourceRepository;
use Doctrine\ORM\EntityManagerInterface;



#[AsCommand(
    name: 'app:import-flore',
    description: 'Importe les données de floreMEd depuis un fichier CSV',
)]
class ImportFloreCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private TaxrefRepository $taxrefRepository;
    private SourceRepository $sourceRepository;

    public function __construct(EntityManagerInterface $entityManager, TaxrefRepository $taxrefRepository, SourceRepository $sourceRepository)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->taxrefRepository = $taxrefRepository;
        $this->sourceRepository = $sourceRepository;
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
	    $filePath = __DIR__ . '/../../export/pterido_g.csv';

	    if (!file_exists($filePath)) {
			$output->writeln('Fichier introuvable');
			return Command::FAILURE;
	    }

	    $handle = fopen($filePath, 'r');

	    $header = fgetcsv($handle, 0, ",");

	    $columns = array_flip($header);
    
	    $batchSize = 500;
	    $i = 0;

	    while (($row = fgetcsv($handle, 0, ",")) !== false) {

			$critere = new Critere();
			
			if(in_array("lb_auteur", $header)){
		
				$plante = $this->taxrefRepository->findByLbNomAndLbAuteur($row[$columns['lb_nom']], $row[$columns['lb_auteur']]); $plante = $this->taxrefRepository->findByLbNomAndLbAuteur($row[$columns['lb_nom']], $row[$columns['lb_auteur']]);
			}else{
				$plante =  $this->taxrefRepository->findOneBy([
								'lb_nom' => $row[$columns['lb_nom']],
							]);
			}
           
			if (!$plante) {
				$output->writeln("Plante non trouvée : " . $row[$columns['lb_nom']] . " " . $row[$columns['lb_auteur']]);
				die();
			}
			$critere->setPlante($plante);
            $critere->setOrgane($row[$columns['organe']]);
            $critere->setDescription($row[$columns['description']]);
            $critere->setSource($this->sourceRepository->find(6));

			$this->entityManager->persist($critere);

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
