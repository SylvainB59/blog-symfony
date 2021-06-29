<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityRegisterController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/register", name="security_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User;

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setPassword($passwordHasher->hashPassword($user,$user->getPassword()));

            // $password_hash = $passwordHasher->hashPassword($user, $user->getPassword());
            // $user->setPassword($password_hash); //la meme qu'au dessus

            $this->manager->persist($user);
            $this->manager->flush();
            return $this->redirectToRoute("home");
        }

        return $this->render('security/index.html.twig', [
            'controller_name' => 'Inscription',
            'form'=>$form->createView()
        ]);
    }

    /**
     * @ Route("/login", name="security_login")
     */
    /*public function login(): Response
    {
        //pas de traitement, juste afficher la vue du formulaire
        return $this->render('security/loginZ.html.twig', [
            'controller_name' => 'Login',

        ]);
    }*/

    /**
     * @ Route("/logout", name="security_logout")
     */
    /*public function logout()
    {
        // juste une redirection gérée dans le security.yaml
    }*/
}
