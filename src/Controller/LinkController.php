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

        return $this->render('link/LinkListALl.html.twig', [
            'values' => $valueRepository->filterValueAll($slug),
            'links' => $linkRepository->filterValue($slug),
            'name_sub' => $subcategory,
        ]);
    }

    /**
     * @Route("/{c_slug}/{slug}", name="link_value")
     */
    public function linkValue($c_slug,$slug, Value $value,
                              ValueRepository $valueRepository): Response
    {

        return $this->render('link/LinkListValue.html.twig', [
            'values' => $valueRepository->filterValue($c_slug),
            'links' => $value->getLinks(),
            'name_sub' => $value,
            'name_ub' => $c_slug,
        ]);
    }
}
