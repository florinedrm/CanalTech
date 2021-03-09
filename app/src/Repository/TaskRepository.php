<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findTotalInvoiced()
    {
        $stmt = $this->createQueryBuilder('t');
        
        $stmt->select('COUNT(t)');
        $stmt->where('t.invoiced = 1');

        return $stmt->getQuery()->getSingleScalarResult();
    }

    public function filter($sortProject, $sortTime)
    {
        $stmt = $this->createQueryBuilder('t');

        if(!empty($sortProject))
        {
            $stmt->leftJoin('t.project', 'p');
            $stmt->where('p.name LIKE :sort');
            $stmt->setParameter('sort', $sortProject);
        }

        switch($sortTime)
        {
            case 'Semaine' :
                break;
            case 'Mois' :
                break;
            case 'Année' :
                break;
        }

        $stmt->orderBy('t.start_at', 'ASC');

        return $stmt->getQuery()->getResult();
    }

    // /**
    //  * @return Task[] Returns an array of Task objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Task
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
