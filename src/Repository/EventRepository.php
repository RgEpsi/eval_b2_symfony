<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }


    public function findUpcomingAndValidated(?string $category = null): array
    {
        $qb = $this->createQueryBuilder('ev')
            ->andWhere('ev.datetime >= :maintenant')
            ->setParameter('maintenant', new \DateTime())
            ->andWhere('ev.status = :valide')
            ->setParameter('valide', true)
            ->orderBy('ev.datetime', 'ASC');

        if ($category) {
            $qb->andWhere('ev.category = :cat')
               ->setParameter('cat', $category);
        }

        return $qb->getQuery()->getResult();
    }


//    /**
//     * @return Event[] Returns an array of Event objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Event
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
