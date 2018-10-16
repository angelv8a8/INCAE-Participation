<?php

namespace App\Controller;

use App\Entity\UserCourseSession;
use App\Form\UserCourseSessionType;
use App\Repository\UserCourseSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/course/session")
 */
class UserCourseSessionController extends AbstractController
{
    /**
     * @Route("/", name="user_course_session_index", methods="GET")
     */
    public function index(UserCourseSessionRepository $userCourseSessionRepository): Response
    {
        return $this->render('user_course_session/index.html.twig', ['user_course_sessions' => $userCourseSessionRepository->findAll()]);
    }

    /**
     * @Route("/new", name="user_course_session_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $userCourseSession = new UserCourseSession();
        $form = $this->createForm(UserCourseSessionType::class, $userCourseSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userCourseSession);
            $em->flush();

            return $this->redirectToRoute('user_course_session_index');
        }

        return $this->render('user_course_session/new.html.twig', [
            'user_course_session' => $userCourseSession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_course_session_show", methods="GET")
     */
    public function show(UserCourseSession $userCourseSession): Response
    {
        return $this->render('user_course_session/show.html.twig', ['user_course_session' => $userCourseSession]);
    }

    /**
     * @Route("/{id}/edit", name="user_course_session_edit", methods="GET|POST")
     */
    public function edit(Request $request, UserCourseSession $userCourseSession): Response
    {
        $form = $this->createForm(UserCourseSessionType::class, $userCourseSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_course_session_edit', ['id' => $userCourseSession->getId()]);
        }

        return $this->render('user_course_session/edit.html.twig', [
            'user_course_session' => $userCourseSession,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_course_session_delete", methods="DELETE")
     */
    public function delete(Request $request, UserCourseSession $userCourseSession): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userCourseSession->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userCourseSession);
            $em->flush();
        }

        return $this->redirectToRoute('user_course_session_index');
    }
}
