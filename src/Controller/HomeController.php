<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $stagiaire = "val";
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'stagiaire' => $stagiaire,
            'something' => [
                34,
                'banane',
                'poire'
            ],
        ]);
    }
}
