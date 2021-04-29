<?php

namespace App\Repository;

use App\Entity\OptionGadget;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OptionGadget|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionGadget|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionGadget[]    findAll()
 * @method OptionGadget[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionGadgetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionGadget::class);
    }

    // /**
    //  * @return OptionGadget[] Returns an array of OptionGadget objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OptionGadget
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
