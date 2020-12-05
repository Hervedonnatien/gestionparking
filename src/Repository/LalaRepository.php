<?php

namespace App\Repository;

use App\Entity\Lala;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lala|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lala|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lala[]    findAll()
 * @method Lala[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LalaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lala::class);
    }

    // /**
    //  * @return Lala[] Returns an array of Lala objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lala
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
