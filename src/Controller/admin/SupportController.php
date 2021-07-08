<?php

namespace App\Controller\admin;

use App\Entity\Support;
use App\Form\SupportType;
use App\Repository\SupportRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/support")
 * @IsGranted("ROLE_ADMIN")
 */
class SupportController extends AbstractController
{
    /**
     * @Route("/", name="support_index", methods={"GET"})
     */
    public function index(SupportRepository $supportRepository): Response
    {
        return $this->render('admin/site/support/index.html.twig', [
            'supports' => $supportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="support_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $support = new Support();
        $form = $this->createForm(SupportType::class, $support);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($support);
            $entityManager->flush();

            return $this->redirectToRoute('support_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/site/support/new.html.twig', [
            'support' => $support,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="support_show", methods={"GET"})
     */
    public function show(Support $support): Response
    {
        return $this->render('admin/site/support/show.html.twig', [
            'support' => $support,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="support_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Support $support): Response
    {
        $form = $this->createForm(SupportType::class, $support);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('support_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/site/support/edit.html.twig', [
            'support' => $support,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="support_delete", methods={"POST"})
     */
    public function delete(Request $request, Support $support): Response
    {
        if ($this->isCsrfTokenValid('delete'.$support->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($support);
            $entityManager->flush();
        }

        return $this->redirectToRoute('support_index', [], Response::HTTP_SEE_OTHER);
    }
}
