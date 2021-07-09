<?php

namespace App\Controller;

use App\Entity\Subcategory;
use App\Entity\Value;
use App\Repository\LinkRepository;
use App\Repository\ValueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinkController extends AbstractController
{
    /**
     * @Route("/{slug}/", name="subcat_link")
     */
    public function link($slug, Subcategory $subcategory,
                          ValueRepository $valueRepository, LinkRepository $linkRepository): Response
    {

        return $this->render('link/linkList.html.twig', [
            'values' => $valueRepository->filterValueAll($slug),
            'links' => $linkRepository->filterValue($slug),
            'name_sub' => $subcategory,
            'name_ub' => $slug,
            'title' => $subcategory->getCategory()->getName() .' '. $subcategory->getName()
        ]);
    }

    /**
     * @Route("/{c_slug}/{slug}", name="link_value")
     */
    public function linkValue($c_slug,$slug, Value $value,
                              ValueRepository $valueRepository): Response
    {

        return $this->render('link/linkList.html.twig', [
            'values' => $valueRepository->filterValue($c_slug),
            'links' => $value->getLinks(),
            'name_sub' => $value,
            'title' => $value->getName() .' ',
            'name_ub' => $c_slug,
        ]);
    }
}
