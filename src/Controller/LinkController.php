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
     * @Route("/link/{slug}/", name="subcat_link")
     */
    public function link($slug, Subcategory $subcategory,
                          ValueRepository $valueRepository, LinkRepository $linkRepository): Response
    {
        $v_slug = $slug;

        return $this->render('link/LinkListALl.html.twig', [
            'values' => $valueRepository->filterValue($v_slug),
            'links' => $linkRepository->filterValue($slug),
            'name_sub' => $subcategory,
        ]);
    }

    /**
     * @Route("/link/{v_slug}/{slug}", name="link_value")
     */
    public function linkValue($v_slug,$slug, Value $value,
                              ValueRepository $valueRepository, LinkRepository $linkRepository): Response
    {
        return $this->render('link/LinkListValue.html.twig', [
            'values' => $valueRepository->filterValue($v_slug),
            'links' => $linkRepository->filterValue($slug),
            'name_sub' => $value,
        ]);
    }
}
