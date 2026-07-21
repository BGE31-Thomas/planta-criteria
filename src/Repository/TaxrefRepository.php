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
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Tausch ex Opiz, 1820")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Lindley) Carrière'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Lamb.) Carrière, 1856")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Endlicher) Carrière'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Endl.) Manetti ex Carrière, 1855")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(D. Don) G. Don'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Roxb. ex D.Don) G.Don, 1830")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(D. Don) Lindley'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Douglas ex D.Don) Lindley, 1833")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Gordon et Glendinning) Hildebrand'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Gordon et Glendinning) Lindley ex Hildebrand, 1861")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Hermos.) J. et P. Devillers-Tersch.'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(C.E.Hermos.) Devillers-Tersch. et Devillers, 1999")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(L.) R. M. Bateman et al.'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(L.) R.M.Bateman, Pridgeon et M.W.Chase, 1997")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === 'W. D. J. Koch'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Saut. ex W.D.J.Koch, 1837")
            ->getQuery()
            ->getOneOrNullResult();
        }

        /* if ($lbAuteur === 'Gussone'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Tineo ex Gussone, 1844")
            ->getQuery()
            ->getOneOrNullResult();
        } */

        if ($lbAuteur === 'Targ.-Tozz.'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "O.Targ.Tozz., 1810")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Planch.) St. John'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Planch.) H.St.John, 1920")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Engelm.) Magnus'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(A. Braun ex Engelm.) Magnus, 1870")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === 'Talavera et al.'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Talavera, P. Garcia-Mur. et H.Smit, 1986")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Vis.) N. E. Br.'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Gasp. ex Vis.) N. E. Br., 1932")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === 'Garcías Font'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Font Quer, 1953")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === 'Kit.'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Kit. ex Schult., 1814")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === '(Vandelli) G. López et C. E. Jarvis'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "(Vand.) G.López et Jarvis, 1984")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if (str_contains($lbAuteur, 'Lledó et al')){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "%Lledó, A.P.Davis et M.B.Crespo%")
            ->getQuery()
            ->getOneOrNullResult();
        }

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

        if ($lbAuteur === 'Durieu'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "Durieu ex Coss., 1875")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if ($lbAuteur === 'Foelsche'){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur = :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "G.Foelsche et W.Foelsche, 1998")
            ->getQuery()
            ->getOneOrNullResult();
        }

        if (str_contains($lbAuteur, 'O. et E. Danesch')){
            dump($lbAuteur);
            return $this->createQueryBuilder('t')
            ->andWhere('t.lb_nom = :val AND t.lb_auteur LIKE :val2')
            ->setParameter('val', $lbNom)
            ->setParameter('val2', "%O.Danesch et E.Danesch%")
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
