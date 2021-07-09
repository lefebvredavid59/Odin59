<?php

namespace App\Controller\admin\link;

use App\Entity\Value;
use App\Form\ValueType;
use App\Repository\ValueRepository;
use App\Service\UploadValue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/link/value")
 * @IsGranted("ROLE_ADMIN")
 */
class ValueController extends AbstractController
{
    /**
     * @Route("/", name="value_index", methods={"GET"})
     */
    public function index(ValueRepository $valueRepository): Response
    {
        return $this->render('admin/link/value/index.html.twig', [
            'values' => $valueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="value_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploadValue $uploadValue): Response
    {
        $value = new Value();
        $form = $this->createForm(ValueType::class, $value);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($image = $form->get('picture')->getData()) {
                $fileName = $uploadValue->upload($image,$value);
                //Mets a jour l'entite
                $value->setPicture($fileName);
            }
            $entityManager->persist($value);
            $entityManager->flush();

            return $this->redirectToRoute('value_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/link/value/new.html.twig', [
            'value' => $value,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="value_show", methods={"GET"})
     */
    public function show(Value $value): Response
    {
        return $this->render('admin/link/value/show.html.twig', [
            'value' => $value,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="value_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Value $value, UploadValue $uploadValue): Response
    {
        $form = $this->createForm(ValueType::class, $value);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($image = $form->get('picture')->getData()) {
                // Supprimer l'image deja existante
                if ($value->getPicture()) {
                    $uploadValue->remove($value->getPicture());
                }
                $fileName = $uploadValue->upload($image,$value);
                //Mets a jour l'entite
                $value->setPicture($fileName);
            }
            $entityManager->flush();

            return $this->redirectToRoute('value_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/link/value/edit.html.twig', [
            'value' => $value,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="value_delete", methods={"POST"})
     */
    public function delete(Request $request, Value $value): Response
    {
        if ($this->isCsrfTokenValid('delete'.$value->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($value);
            $entityManager->flush();
        }

        return $this->redirectToRoute('value_index', [], Response::HTTP_SEE_OTHER);
    }
}
