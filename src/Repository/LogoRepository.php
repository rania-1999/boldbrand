<?php

namespace App\Repository;

use App\Entity\Commentaire;
use App\Entity\DoctrineMigrationVersions;
use App\Entity\Logo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Logo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Logo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Logo[]    findAll()
 * @method Logo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Logo::class);
    }

    // /**
    //  * @return DoctrineMigrationVersions[] Returns an array of DoctrineMigrationVersions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DoctrineMigrationVersions
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
