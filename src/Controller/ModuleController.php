<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Course;
use App\Entity\Program;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use App\Repository\CourseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/module")
 */
class ModuleController extends AbstractController
{
    /**
     * @Route("/", name="module_index", methods="GET")
     */
    public function index(ModuleRepository $moduleRepository): Response
    {
        return $this->render('module/index.html.twig', ['modules' => $moduleRepository->findAll()]);
    }
    /**
     * @Route("/module-courses/{id}", name="module_courses", methods="GET")
     */
    public function modules(Module $module, CourseRepository $courseRepository): Response
    {
        $courses = $courseRepository->findBy([ 'module' => $module]);
        return $this->render('module/courses.html.twig', ['courses' => $courses,'module' => $module]);
    }

    /**
     * @Route("/new/{id}", name="module_new", methods="GET|POST")
     */
    public function new(Request $request, Program $program): Response
    {
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $module->setProgram($program);

            $em->persist($module);
            $em->flush();

            return $this->redirectToRoute('program_modules', array('id'=> $module->program->getId()));
        }
        return $this->render('module/new.html.twig', [
            'module' => $module,
            'form' => $form->createView(),
            'program'=>$program
        ]);
    }

    /**
     * @Route("/{id}", name="module_show", methods="GET")
     */
    public function show(Module $module): Response
    {
        return $this->render('module/show.html.twig', ['module' => $module]);
    }

    /**
     * @Route("/{id}/edit", name="module_edit", methods="GET|POST")
     */
    public function edit(Request $request, Module $module): Response
    {
        
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Modulo actualizado.'
            );

            return $this->redirectToRoute('module_show', ['id' => $module->getId()]);
        }

        return $this->render('module/edit.html.twig', [
            'module' => $module,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="module_delete", methods="DELETE")
     */
    public function delete(Request $request, Module $module): Response
    {
        $programId = $module->program->getId();
        if ($this->isCsrfTokenValid('delete'.$module->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($module);
            $em->flush();
        }

        return $this->redirectToRoute('program_modules', array('id'=>$programId));
    }
}
