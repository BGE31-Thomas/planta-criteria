<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Entity\Statut;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:import-statuts',
    description: 'Import des différents statuts possibles pour les critères d\'une observation',
)]
class ImportStatutsCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
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
        $statut1 = new Statut();
        $statut1->setLibelle("Non vérifié");

        $statut2 = new Statut();
        $statut2->setLibelle("Absent");

        $statut3 = new Statut();
        $statut3->setLibelle("Présent");

        $statut4 = new Statut();
        $statut4->setLibelle("Partiellement présent");

        $cpt = 0;
        $entityManager = $this->entityManager;
        $entityManager->persist($statut1);
        $cpt++;
        $entityManager->persist($statut2);
        $cpt++;
        $entityManager->persist($statut3);
        $cpt++;
        $entityManager->persist($statut4);
        $cpt++;
        $entityManager->flush();

        $output->writeln("Import terminé : $cpt statuts");

        return Command::SUCCESS;
    }
}
