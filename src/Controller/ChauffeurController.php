<?php

namespace App\Controller;

use App\Entity\Chauffeur;
use App\Form\ChauffeurType;
use App\Repository\ChauffeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChauffeurController extends AbstractController
{

    /**
     * @var ChauffeurRepository
     */
    private $repository;

    public function __construct(ChauffeurRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/chauffeur", name="chauffeur")
     */
    public function index(Request $request)
    {
        $chauffeur1 = $this->repository->findAll();

        $chauffeur = new Chauffeur();
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($chauffeur);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('chauffeur');
        }

        return $this->render('chauffeur/index.html.twig', [
            'chauffeur' => $chauffeur1,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/chauffeur/{id}/edit", name="editChauffeur", methods="GET|POST")
     * @param Chauffeur $chauffeur
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Chauffeur $chauffeur, Request $request)
    {
        $form = $this->createForm(ChauffeurType::class, $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien editée avec succès');
            return $this->redirectToRoute('chauffeur');
        }
        return $this->render('chauffeur/edit.html.twig', [
            'chauffeur' => $chauffeur,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/chauffeur/{id}", name="deleteChauffeur", methods="DELETE")
     * @param Chauffeur $chauffeur
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Chauffeur $chauffeur, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $chauffeur->getId(), $request->get('_token'))) {
            $this->em->remove($chauffeur);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimée avec succès');
        }
        return $this->redirectToRoute('$chauffeur');
    }

    /**
     * @Route("chauffeur/{id}", name="chauffeur_show")
     */
    public function show(Chauffeur $chauffeur)
    {
        $form = $this->createForm(ChauffeurType::class, $chauffeur);

        if ($form->isSubmitted() && $form->isValid()) {
        }
        return $this->render('chauffeur/show.html.twig', [
            'chauffeur' => $chauffeur,
        ]);
    }
}
