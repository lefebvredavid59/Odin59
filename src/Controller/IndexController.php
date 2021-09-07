<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\SupportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('site/index.html.twig', [
            'cates' => $categoryRepository->categsleft(),
        ]);
    }

    /**
     * @Route("/don", name="don")
     */
    public function don(SupportRepository $supportRepository): Response
    {
        return $this->render('site/don.html.twig', [
            'supports' => $supportRepository->OrderByAlpha(),
        ]);
    }
}
