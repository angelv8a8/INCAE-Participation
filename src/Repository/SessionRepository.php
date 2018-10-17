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
        $sub_query = '(SELECT COUNT(ucs.id) FROM App\Entity\UserCourseSession ucs WHERE ucs.teacherReviewed = true AND ucs.courseSession = s.id)';


        return $this->createQueryBuilder('s')
            ->addSelect($sub_query . ' as studentReviewed')
            ->addSelect($sub_query . ' as teacherReviewed')
            ->andWhere('s.course = :course')
            ->setParameter('course', $course)
            ->orderBy('s.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findSessionDetails($session)
    {
        // Subquery that counts the number of tags per post.
        $sub_query = '(SELECT COUNT(ucs.id) FROM App\Entity\UserCourseSession ucs WHERE ucs.studentReviewed = true AND ucs.courseSession = s.id)';
        $sub_query2 = '(SELECT COUNT(ucs2.id) FROM App\Entity\UserCourseSession ucs2 WHERE ucs2.teacherReviewed = true AND ucs2.courseSession = s.id)';
        $sub_query3 = '(SELECT COUNT(ucs3.id) FROM App\Entity\UserCourseSession ucs3 WHERE ucs3.courseSession = s.id)';
        $sub_query4 = '(SELECT AVG(ucs4.studentNote) FROM App\Entity\UserCourseSession ucs4 WHERE ucs4.courseSession = s.id)';
        $sub_query5 = '(SELECT AVG(ucs5.teacherNote) FROM App\Entity\UserCourseSession ucs5 WHERE ucs5.courseSession = s.id)';


        return $this->createQueryBuilder('s')
            ->addSelect($sub_query . ' as studentReviewed')
            ->addSelect($sub_query2 . ' as teacherReviewed')
            ->addSelect($sub_query3 . ' as total')
            ->addSelect($sub_query4 . ' as studentAverage')
            ->addSelect($sub_query5 . ' as teacherAverage')
            ->andWhere('s.id = :id')
            ->setParameter('id', $session->getId())
            ->getQuery()
            ->getOneOrNullResult()
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
