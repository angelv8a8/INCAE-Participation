<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Module;
use App\Repository\ModuleRepository;
/**
 * @Route("/admin/program")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="program_index", methods="GET")
     */
    public function index(ProgramRepository $programRepository): Response
    {
        return $this->render('program/index.html.twig', ['programs' => $programRepository->findAll()]);
    }

    /**
     * @Route("/program-modules/{id}", name="program_modules", methods="GET")
     */
    public function modules(Program $program, ModuleRepository $moduleRepository): Response
    {
        return $this->render('program/modules.html.twig', ['modules' => $moduleRepository->findAll(),'program' => $program]);
    }

    /**
     * @Route("/new", name="program_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($program);
            $em->flush();

            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/new.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_show", methods="GET")
     */
    public function show(Program $program): Response
    {
        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    /**
     * @Route("/{id}/edit", name="program_edit", methods="GET|POST")
     */
    public function edit(Request $request, Program $program): Response
    {
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('program_edit', ['id' => $program->getId()]);
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="program_delete", methods="DELETE")
     */
    public function delete(Request $request, Program $program): Response
    {
        
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($program);
            $em->flush();
        }

        return $this->redirectToRoute('program_index');
    }
}
