<?php

namespace App\Repository;

use App\Entity\Chart;
use App\Entity\Commentaire;
use App\Entity\DoctrineMigrationVersions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chart[]    findAll()
 * @method Chart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chart::class);
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
    public function search($term)
    {
        return $this->createQueryBuilder('Chart')
            ->andWhere('Chart.idClient LIKE :nom')
            ->setParameter('nom', '%'.$term.'%')
            ->getQuery()
            ->execute();
    }

}
