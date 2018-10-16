<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Course;
use App\Entity\Session;
use App\Repository\UserCourseSessionRepository;
use App\Entity\UserCourseSession;
use App\Form\UserCourseSessionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/student/tools")
 */
class StudentToolsController extends AbstractController
{

    

    /**
     * @Route("/course/{id}", name="student_course")
     */
    public function course(UserCourseSessionRepository $userCourseSesssionRepository, Course $course)
    {
        $sessions = $userCourseSesssionRepository->findByUserAndCourse($this->getUser(), $course);

        return $this->render('student_tools/course.html.twig', [
            'course' => $course,
            'sessions' => $sessions

        ]);
    }

    /**
     * @Route("/session/{id}", name="student_session" , methods="GET|POST")
     */
    public function session(Request $request, UserCourseSession $userCourseSession)
    {

        $form = $this->createForm(UserCourseSessionType::class, $userCourseSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userCourseSession->setStudentReviewed(true);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_course', ['id' => $userCourseSession->getCourseSession()->getCourse()->getId()]);
        }

        return $this->render('student_tools/session.html.twig', [
            'session' => $userCourseSession,
            'form' => $form->createView(),
        ]);
    }
}

