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

        if ($lbNom === 'Sternbergia lutea'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(L.) Ker Gawl. ex Spreng., 1825")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Sternbergia sicula'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Tineo ex Gussone, 1844")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Triglochin bulbosa'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "sensu Guin. et R.Vilm., 1978")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Muscari matritense'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Ruíz Rejón, Pascual, C.Ruíz Rejón, Valdés et J.L.Oliv., 1986")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Muscari neglectum'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Gussone ex Ten., 1842")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Carex humilis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Leyss., 1758")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Carex brizoides'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "L., 1755")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Carex canescens'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "L., 1753")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Festuca arvernensis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Auquier, Kerguélen et Markgr.-Dann., 1978")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Gagea pratensis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Pers.) Dumort., 1827")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Orchis olbiensis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Reut. ex Gren., 1859")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Orchis provincialis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Balbis ex DC., 1806")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Serapias strictiflora'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Welw. ex Veiga, 1886")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Serapias strictiflora'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Welw. ex Veiga, 1886")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Ophrys arachnitiformis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Gren. et M.Philippe, 1859")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Ophrys passionis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Sennen, 1926")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbNom === 'Iris spuria'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "auct. non L., 1753")
            ->getQuery()
            ->getOneOrNullResult();
        }

       
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


}
