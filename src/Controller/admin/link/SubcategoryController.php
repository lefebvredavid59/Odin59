<?php

namespace App\Controller\admin\link;

use App\Entity\Subcategory;
use App\Form\SubcategoryType;
use App\Repository\SubcategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/subcategory")
 * @IsGranted("ROLE_ADMIN")
 */
class SubcategoryController extends AbstractController
{
    /**
     * @Route("/", name="subcategory_index", methods={"GET"})
     */
    public function index(SubcategoryRepository $subcategoryRepository): Response
    {
        return $this->render('admin/link/subcategory/index.html.twig', [
            'subcategories' => $subcategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subcategory_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subcategory = new Subcategory();
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subcategory);
            $entityManager->flush();

            return $this->redirectToRoute('subcategory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/link/subcategory/new.html.twig', [
            'subcategory' => $subcategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subcategory_show", methods={"GET"})
     */
    public function show(Subcategory $subcategory): Response
    {
        return $this->render('admin/link/subcategory/show.html.twig', [
            'subcategory' => $subcategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subcategory_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subcategory $subcategory): Response
    {
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subcategory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/link/subcategory/edit.html.twig', [
            'subcategory' => $subcategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subcategory_delete", methods={"POST"})
     */
    public function delete(Request $request, Subcategory $subcategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subcategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subcategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subcategory_index', [], Response::HTTP_SEE_OTHER);
    }
}
