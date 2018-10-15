<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Course;
use App\Entity\UserCourseSession;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/teaacher/session")
 */
class SessionController extends AbstractController
{
    /**
     * @Route("/", name="session_index", methods="GET")
     */
    public function index(SessionRepository $sessionRepository): Response
    {
        return $this->render('session/index.html.twig', ['sessions' => $sessionRepository->findAll()]);
    }

    /**
     * @Route("/new/{id}", name="session_new", methods="GET|POST")
     */
    public function new(Request $request, Course $course): Response
    {

        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->setCourse($course);
            $em = $this->getDoctrine()->getManager();

            foreach( $course->getStudents() as $student)
            {
                $userSession = new UserCourseSession();
                $userSession->setCourseSession($session);
                $userSession->setUser($student);
                $em->persist($userSession);
            }
            $em->persist($session);
            $em->flush();

            return $this->redirectToRoute('teacher_course',['id'=>$course->getId()] );
        }

        return $this->render('session/new.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
            'course' => $course
        ]);
    }

    /**
     * @Route("/{id}", name="session_show", methods="GET")
     */
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', ['session' => $session]);
    }

    /**
     * @Route("/{id}/edit", name="session_edit", methods="GET|POST")
     */
    public function edit(Request $request, Session $session): Response
    {
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('session_edit', ['id' => $session->getId()]);
        }

        return $this->render('session/edit.html.twig', [
            'session' => $session,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="session_delete", methods="DELETE")
     */
    public function delete(Request $request, Session $session): Response
    {
        if ($this->isCsrfTokenValid('delete'.$session->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($session);
            $em->flush();
        }

        return $this->redirectToRoute('session_index');
    }
}
