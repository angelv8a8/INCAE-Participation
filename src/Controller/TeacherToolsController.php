<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Course;
use App\Entity\Session;

/**
 * @Route("/teacher/tools")
 */
class TeacherToolsController extends AbstractController
{
    /**
     * @Route("/course/{id}", name="teacher_course")
     */
    public function course(Course $course)
    {
        return $this->render('teacher_tools/course.html.twig', [
            'course' => $course,
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
}

