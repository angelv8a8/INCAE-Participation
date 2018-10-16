<?php

namespace App\Repository;

use App\Entity\UserCourseSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCourseSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCourseSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCourseSession[]    findAll()
 * @method UserCourseSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCourseSessionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCourseSession::class);
    }

    /**
     * @return UserCourseSession[] Returns an array of UserCourseSession objects
     */
    
    public function findByUserAndCourse($user, $course)
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.courseSession', 's')
            ->andWhere('s.course = :course')
            ->andWhere('u.user = :user')
            ->setParameter('course', $course)
            ->setParameter('user', $user)
            ->orderBy('s.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?UserCourseSession
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
