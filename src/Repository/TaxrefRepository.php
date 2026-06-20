<?php

namespace App\Repository;

use App\Entity\Taxref;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Taxref>
 */
class TaxrefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Taxref::class);
    }

    /**
     * @return Taxref Returns a Taxref object
     */
   public function findByLbNomAndLbAuteur(string $lbNom, string $lbAuteur): ?Taxref
   {
        if (str_contains($lbAuteur, 'Schrank et Martius')){
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', '%Schrank et Mart.%')
            ->getQuery()
            ->getOneOrNullResult();
        }
        

        if (str_contains($lbAuteur, '(Döll) Koch')){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(A. Braun ex Döll) W.D.J.Koch, 1845")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if (str_contains($lbAuteur, '(Döll) Druce')){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(A. Braun ex Döll) Druce, 1908")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if (str_contains($lbAuteur, '(Forssk.) Woyn.')){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Forssk.) T.Moore ex Woyn., 1913")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if (str_contains($lbAuteur, '(Willd.) Kunkel')){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Willd.) G.Kunkel, 1966")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if (str_contains($lbAuteur, '(L.) R. Brown')){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(L.) R.Br. ex Hook., 1842")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === 'Opiz'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Tausch ex Opiz, 1820")
            ->getQuery()
            ->getOneOrNullResult();
        }

        /* if (str_contains($lbAuteur, '. ')){
            $lbAuteur = str_replace('. ', '.', $lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "$lbAuteur%")
            ->getQuery()
            ->getOneOrNullResult();
        } */
       
        return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "$lbAuteur,%")
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByLbNom(string $lbNom): ?Taxref
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val')
            ->setParameter('val', $lbNom)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    public function findOneBySomeField($value): ?Taxref
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
