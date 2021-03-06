<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Course;
use App\Entity\Session;
use App\Entity\UserCourseSession;
use App\Repository\SessionRepository;
use App\Repository\CourseRepository;
use App\Repository\UserRepository;
use App\Repository\UserCourseSessionRepository;
use App\Form\UserCourseSessionReviewType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/teacher/tools")
 */
class TeacherToolsController extends AbstractController
{
    /**
     * @Route("/course/{id}", name="teacher_course")
     */
    public function course(SessionRepository $sessionRepository, Course $course)
    {
        $sessions = $sessionRepository->findByCourseWithTotals($course);

        return $this->render('teacher_tools/course.html.twig', [
            'course' => $course,
            'sessions' => $sessions 
        ]);
    }

    /**
     * @Route("/course-session/{id}", name="teacher_course_session")
     */
    public function session(Session $session, UserCourseSessionRepository $ucsr, SessionRepository $sessionRepository)
    {
        $sessionDetails = $sessionRepository->findSessionDetails($session);

        $userCourseSessions = $ucsr->findBy(array('courseSession'=>$session), array('studentReviewed'=>'DESC') );
        return $this->render('teacher_tools/session.html.twig', [
            'session' => $session,
            'userCourseSession' => $userCourseSessions,
            'sessionDetails' =>$sessionDetails
        ]);
    }

    /**
     * @Route("/course-student-notes-export/{id}", name="teacher_course_student_notes_exports")
     */
     public function studentNotesExport(Course $course, UserCourseSessionRepository $ucsr, SessionRepository $sessionRepository)
     {

        $sessions = $sessionRepository->findBy(array('course'=>$course),array('id'=>'asc'));

        $headers = array('Id','Nombre') ;

        foreach($sessions as $session )
        {
            $headers[]  = $session->getName();
        }

        $rows = array();
        $rows[] ="\xEF\xBB\xBF"; // UTF-8 BOM
        $rows[] = implode(',', $headers );
        
        
        foreach($course->getStudents() as $student)
        {
            $userNotes = $ucsr->findUserNotes($course, $student);

            $notes = array();
            $notes[] = $student->getIncaeId();
            $notes[] = $student->getFullName();

            foreach($userNotes as $sessionNote)
            {
                $notes[] = $sessionNote['teacherNote'] ? $sessionNote['teacherNote'] : $sessionNote['studentNote'];
            }
            $rows[] = implode(',', $notes);
        }

        $content = implode("\n", $rows);
        $response = new Response($content);
        $response->headers->set('Content-Encoding', 'UTF-8');
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename='. $course->getLongName() .'.csv' );
        
        return $response;

     }

    /**
     * @Route("/course-student-notes/{id}", name="teacher_course_student_notes")
     */
    public function studentNotes(Course $course, UserRepository $userRepository)
    {
        $students = $userRepository->findStudentSummary($course);

        //$userCourseSessions = $ucsr->findBy(array('courseSession'=>$session), array('studentReviewed'=>'DESC') );

        return $this->render('teacher_tools/course-results.html.twig', [
            'students' => $students,
            'course' =>$course
        ]);
    }

    /**
     * @Route("/course-student-notes-detail/{id}", name="teacher_course_student_notes_detail")
     */
    public function studentNotesDetail(Course $course, UserCourseSessionRepository $ucsr, SessionRepository $sessionRepository)
    {
        $sessions = $sessionRepository->findBy(array('course'=>$course),array('id'=>'asc'));

        $users = array();

        foreach($course->getStudents() as $student)
        {
            $userNotes = $ucsr->findUserNotes($course, $student);

            $notes = array();
            $notes[] = $student->getIncaeId();
            $notes[] = $student->getFullName();

            foreach($userNotes as $sessionNote)
            {
                $notes[] = $sessionNote['teacherNote'] ? $sessionNote['teacherNote'] : $sessionNote['studentNote'];
            }
            $users[] = $notes;
        }

        //$userCourseSessions = $ucsr->findBy(array('courseSession'=>$session), array('studentReviewed'=>'DESC') );

        return $this->render('teacher_tools/course-results-detail.html.twig', [
            'course' =>$course,
            'sessions' => $sessions,
            'users' => $users
        ]);
    }

    /**
     * @Route("/course-session-review/{id}", name="teacher_session_review", methods="GET|POST")
     */
    public function sessionReview(Request $request, UserCourseSessionRepository $ucs, Session $session)
    {
        $userCourseSession = $ucs->findNexUserToReview($session);

        $form = $this->createForm(UserCourseSessionReviewType::class, $userCourseSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userCourseSession->setTeacherReviewed(true);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_session_review', ['id' => $userCourseSession->getCourseSession()->getId()]);
        }
        else if($userCourseSession)
        {
            if($userCourseSession->getStudentNote())
                $form->get('teacherNote')->setData($userCourseSession->getStudentNote() );
        }
        else
        {
            $this->addFlash(
                'success',
                'Se han evaluado todos los estudiantes.'
            );
            return $this->redirectToRoute('teacher_course_session',['id'=>$session->getId()]);

        }

        return $this->render('teacher_tools/session-review.html.twig', [
            'session' => $session,
            'userCourseSession' => $userCourseSession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/close-session/{id}", name="teacher_close_session")
     */
    public function close(Session $session)
    {
        $em = $this->getDoctrine()->getManager();
        $session->setStudentCanUpdate(false);
        $em->persist($session);
        $em->flush();

        return $this->redirectToRoute('teacher_course_session', ['id' => $session->getId()] );   
    }

    /**
     * @Route("/open-session/{id}", name="teacher_open_session")
     */
    public function open(Session $session)
    {
        $em = $this->getDoctrine()->getManager();
        $session->setStudentCanUpdate(true);
        $em->persist($session);
        $em->flush();

        return $this->redirectToRoute('teacher_course_session', ['id' => $session->getId()] );
    }
}

