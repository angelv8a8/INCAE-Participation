<?php

namespace App\Repository;

use App\Entity\Session;
use App\Entity\UserCourseSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Session::class);
    }

//    /**
//     * @return Session[] Returns an array of Session objects
//     */
    
    public function findByCourseWithTotals($course)
    {
        // Subquery that counts the number of tags per post.
        $sub_query = '(SELECT COUNT(ucs.id) FROM App\Entity\UserCourseSession ucs WHERE ucs.studentReviewed = true AND ucs.courseSession = s.id)';


        return $this->createQueryBuilder('s')
            ->addSelect($sub_query . ' as reviewed')
            ->andWhere('s.course = :course')
            ->setParameter('course', $course)
            ->orderBy('s.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Session
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
