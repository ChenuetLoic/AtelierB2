<?php

namespace App\Repository;

use App\Entity\PicturesProjet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PicturesProjet|null find($id, $lockMode = null, $lockVersion = null)
 * @method PicturesProjet|null findOneBy(array $criteria, array $orderBy = null)
 * @method PicturesProjet[]    findAll()
 * @method PicturesProjet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PicturesProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PicturesProjet::class);
    }

    // /**
    //  * @return PicturesProjet[] Returns an array of PicturesProjet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PicturesProjet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
