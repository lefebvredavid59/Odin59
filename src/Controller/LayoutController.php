<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LayoutController extends AbstractController
{
    public function _header(): Response
    {
        return $this->render('layout/_header.html.twig', [
        ]);
    }

    public function _left(): Response
    {
        return $this->render('layout/_left.html.twig', [
        ]);
    }
}
