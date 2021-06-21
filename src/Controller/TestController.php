<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @Route("/nv-page", name="nv-page")
     */
    public function nvPage(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }

    /**
     * @Route("/nv-page-param/{nom}", name="nv-page")
     */
    public function nvPageParam(string $nom): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Bonjour '.$nom.' ! Lucky number: ' . $number . '</body></html>'
        );
    }

    /**
     * @Route("/nouvelle-action/{nom}", name="nv-page")
     */
    public function nouvelleAction(string $nom): Response
    {
        return new Response(
            '<html><body><h1>'.$nom.'</h1></body></html>'
        );
    }

    /**
     * @Route("/test/{nom}/{min}", name="test2")
     */
    public function index2(string $nom, int $min): Response
    {
        $taille=strlen($nom);
        return $this->render('test/index2.html.twig', [
            'nom' => $nom,
            'min' => $min,
            'taille' => $taille,
        ]);
    }
}
