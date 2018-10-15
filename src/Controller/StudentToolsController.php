<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Course;
use App\Repository\UserCourseSessionRepository;

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
            'course' => $course
        ]);
    }
}
