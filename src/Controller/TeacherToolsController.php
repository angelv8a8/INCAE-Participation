<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Course;
use App\Entity\Session;
use App\Entity\UserCourseSession;
use App\Repository\SessionRepository;
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
    public function session(Session $session)
    {
        return $this->render('teacher_tools/session.html.twig', [
            'session' => $session,
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
        else
        {
            if($userCourseSession->getStudentNote())
                $form->get('teacherNote')->setData($userCourseSession->getStudentNote() );
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

