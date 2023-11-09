<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilControllerController extends AbstractController
{
    /**
     * @Route("/acceuil/controller", name="app_acceuil_controller")
     */
    public function index(): Response
    {
        return $this->render('acceuil_controller/index.html.twig', [
            'controller_name' => 'AcceuilControllerController',
        ]);
    }
}
