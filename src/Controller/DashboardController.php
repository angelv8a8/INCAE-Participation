<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserAccountType;;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\ImageResizer;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\HttpFoundation\File\Exception\FileException;


use Symfony\Component\Security\Core\Encoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class DashboardController extends AbstractController
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    private $encoder;
    /**
     * @Route("/account/{id}", name="user_profile", methods="GET|POST")
     */
    public function account(Request $request, User $user)
    {
        $sessionUser = $this->getUser();

        if($sessionUser->getId() != $user->getId())
        {
            return $this->redirectToRoute('user_profile',['id'=>$sessionUser->getId()]);
        }

        $form = $this->createForm(UserAccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($file = $user->avatarFile)
            {
                // $file stores the uploaded 
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $user->avatarFile;

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('avatar_location'),
                        $fileName
                    );

                    $originalFile = $this->getParameter('avatar_location') . '/' . $fileName;
                    $newPath = $this->getParameter('avatar_location') . '200px/' ;
                    $resizer = new ImageResizer();

                    $resizer->resizeImage(
                        $originalFile , 
                        $newPath, 
                        $height=200);
                    
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochure' property to store the PDF file name
                // instead of its contents
                $user->setAvatar($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'El perfil se ha actualizado.'
            );

            return $this->redirectToRoute('user_profile',['id'=>$sessionUser->getId()]);

        }

        return $this->render('dashboard/account.html.twig', 
        [
            'user' => $user,
            'form' => $form->createView()
        ]
    );

    }

    /**
     * @Route("/account-change-password/{id}", name="user_change_password", methods="GET|POST")
     */
    public function accountChangePassword(Request $request, User $user)
    {
        $sessionUser = $this->getUser();

        if($sessionUser->getId() != $user->getId())
        {
            $this->addFlash(
                'danger',
                'Acceso denegado.'
            );
            return $this->redirectToRoute('user_profile',['id'=>$sessionUser->getId()]);
        }

        $form = $this->createFormBuilder()
            ->add('password', PasswordType::class, array('label'=>'Antigua contraseña'))
            ->add('newPassword', PasswordType::class, array('label'=>'Nueva contraseña'))
            ->add('confirmPassword', PasswordType::class, array('label'=>'Confirmar nueva contraseña'))
            ->getForm();

        //$form = $this->createForm(UserAccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldP = $this->encodePassword($user, $form->get('password')->getData());

            $newP = $this->encodePassword($user, $form->get('newPassword')->getData());
            $conP = $this->encodePassword($user, $form->get('confirmPassword')->getData());
            

            /*if($oldP != $user->getPassword())
            {
                $this->addFlash(
                    'danger',
                    'La contraseña anterior no es valida.'
                );
            }
            else */
            if($form->get('confirmPassword')->getData() != $form->get('newPassword')->getData())
            {
                $this->addFlash(
                    'danger',
                    'Las contraseñas no coinciden.'
                );
            }
            else
            {
                $user->setPassword(
                    $newP
                );

                $this->getDoctrine()->getManager()->flush();

                $this->addFlash(
                    'success',
                    'El perfil se ha actualizado.'
                );

                return $this->redirectToRoute('user_profile',['id'=>$sessionUser->getId()]);
            }

        }

        return $this->render('dashboard/change_password.html.twig', 
        [
            'user' => $user,
            'form' => $form->createView()
        ]
    );

    }


    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }


     /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    private function encodePassword($user, $password)
    {
        return $this->encoder->encodePassword($user,$password);
    }
}
