<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class LayoutController extends AbstractController
{
    public function _header(): Response
    {
        return $this->render('layout/_header.html.twig', [
        ]);
    }

    public function _left(CategoryRepository $categoryRepository): Response
    {
        return $this->render('layout/_left.html.twig', [
            'categs' => $categoryRepository->categsleft()
        ]);
    }

    public function _footer(): Response
    {
        return $this->render('layout/_footer.html.twig', [
        ]);
    }
}
