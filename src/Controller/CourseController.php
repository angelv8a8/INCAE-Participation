<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Module;
use App\Form\CourseType;
use App\Repository\CourseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/course")
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/", name="course_index", methods="GET")
     */
    public function index(CourseRepository $courseRepository): Response
    {
        return $this->render('course/index.html.twig', ['courses' => $courseRepository->findAll()]);
    }

    /**
     * @Route("/new/{id}", name="course_new", methods="GET|POST")
     */
    public function new(Request $request, Module $module): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $course->setModule($module);
            $em->persist($course);
            $em->flush();

            return $this->redirectToRoute('module_courses', array('id'=>$course->module->getId()));
        }

        return $this->render('course/new.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
            'module' =>$module
        ]);
    }

    /**
     * @Route("/{id}", name="course_show", methods="GET")
     */
    public function show(Course $course): Response
    {
        return $this->render('course/show.html.twig', ['course' => $course]);
    }

    /**
     * @Route("/{id}/edit", name="course_edit", methods="GET|POST")
     */
    public function edit(Request $request, Course $course): Response
    {
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        $moduleId = $course->module->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('module_courses', ['id' => $moduleId]);
        }

        return $this->render('course/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="course_delete", methods="DELETE")
     */
    public function delete(Request $request, Course $course): Response
    {
        $module_id = $course->module->getId();
        if ($this->isCsrfTokenValid('delete'.$course->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($course);
            $em->flush();
        }

        return $this->redirectToRoute('module_courses', array('id'=>$module_id));
    }
}
