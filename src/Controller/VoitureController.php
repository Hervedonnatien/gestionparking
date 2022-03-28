<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VoitureController extends AbstractController
{

    /**
     * @var VoitureRepository
     */
    private $repository;

    public function __construct(VoitureRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/voiture", name="voiture")
     */
    public function index(Request $request)
    {
        $voiture1 = $this->repository->findAll();

        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($voiture);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('voiture');
        }

        return $this->render('voiture/index.html.twig', [
            'voiture' => $voiture1,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/voiture/{id}/edit", name="editVoiture", methods="GET|POST")
     */
    public function edit(Voiture $voiture, Request $request)
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien editée avec succès');
            return $this->redirectToRoute('voiture');
        }
        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/voiture/{id}", name="deleteVoiture", methods="DELETE")
     * @param Voiture $voiture
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Voiture $voiture, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $voiture->getId(), $request->get('_token'))) {
            $this->em->remove($voiture);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimée avec succès');
        }
        return $this->redirectToRoute('voiture');
    }

    /**
     * @Route("voiture/{id}", name="voiture_show")
     */
    public function show(Voiture $voiture)
    {
        $form = $this->createForm(VoitureType::class, $voiture);

        if ($form->isSubmitted() && $form->isValid()) {
        }
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }
}
