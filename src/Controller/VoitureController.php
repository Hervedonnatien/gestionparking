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
     * @var ClientRepository
     */
    private $repository;

    public function __construct(VoitureRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/voiture", name="voiture")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $voiture1 = $this->repository->findAll();

        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //recuperation d'image
            $image = $form->get('image')->getData();
            //boucle
            foreach ($image as $image) {
                //generer un fichier dans uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $this->fichier
                );
                // on stocke l'image dans la base de données

            }
            $this->em->getDoctrine()->getManager();
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
     * @param Voiture $voiture
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Voiture $voiture, Request $request)
    {
        return $this->json($voiture, 200);
    }

    /**
     * @Route("/update/{id}", name="update", methods="POST")
     */
    public function update(Voiture $voiture, Request $request)
    {
        $data = $request->request;
        $data = $data->all();
        $voiture->setNumVoiture($data['numVoiture'])
            ->setCooperative($data['cooperative'])
            ->setTypeVoiture($data['typeVoiture'])
            ->setLigne($data['ligne'])
            ->setVisuel($data['visuel'])
            ->setNomProprietaire($data['nomProprietaire'])
            ->setImage($data['image']);

        $this->em->persist($voiture);
        $this->em->flush();
        return $this->redirectToRoute('voiture');
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
     * @Route("/voiture_add", name="addVoiture")
     */
    public function add(Request $request)
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->getDoctrine()->getManager();
            $this->em->persist($voiture);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('voiture');
        }
        return $this->render('voiture/add.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView()
        ]);
    }
}
