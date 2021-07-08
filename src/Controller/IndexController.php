<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/don", name="don")
     */
    public function don(): Response
    {
        return $this->render('site/don.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/emailview", name="emailview")
     */
    public function emailview(): Response
    {
        return $this->render('registration/confirmation_email.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
