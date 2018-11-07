<?php

namespace App\Repository;

use App\Entity\UserCourseSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\ResultSetMapping;

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


    public function findNexUserToReview($session)
    {
        return $this->createQueryBuilder('u')
            ->innerJoin('u.courseSession', 's')
            ->andWhere('u.courseSession = :session')
            ->andWhere('u.teacherReviewed = :reviewed')
            ->setParameter('session', $session)
            ->setParameter('reviewed', false)
            ->setMaxResults( 1 )
            ->orderBy('u.studentNote','DESC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

 

    /**
     * @return UserCourseSession[] Returns an array of UserCourseSession objects
     */
    public function findUserNotes($course, $user)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('name', 'name');
        $rsm->addScalarResult('date', 'date');
        $rsm->addScalarResult('student_note', 'studentNote');
        $rsm->addScalarResult('teacher_note', 'teacherNote');

        $query = $this->getEntityManager()->createNativeQuery('select s.id, s.name, s.date, ucs.student_note, teacher_note from (select * from session where course_id = ?) s left join (select * from user_course_session where user_id = ?) ucs on s.id = ucs.course_session_id order by s.id asc', $rsm);
        $query->setParameter(1, $course->getId());
        $query->setParameter(2, $user->getId());

        return $query->getResult();

    }
    
}
