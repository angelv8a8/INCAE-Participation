<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request , AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $userName = $authUtils->getLastUserName();
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'error' => $error,
            'last_username' => $userName
        ]);
    }

     /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        return [];
    }
}
