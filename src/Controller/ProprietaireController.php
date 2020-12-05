<?php

namespace App\Controller;

use App\Entity\Proprietaire;
use App\Form\ProprietaireType;

use function PHPSTORM_META\type;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProprietaireRepository;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class ProprietaireController extends AbstractController
{
    /**
     * @var ProprietaireRepository
     */
    private $repository;

    public function __construct(ProprietaireRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/proprietaire", name="proprietaire")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $proprietaire1 = $this->repository->findAll();

        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($proprietaire);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajouté avec succès');
            return $this->redirectToRoute('proprietaire');
        }
        return $this->render('proprietaire/index.html.twig', [
            'proprietaire' => $proprietaire1,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/proprietaire/{id}/edit", name="editProprietaire", methods="GET|POST")
     * @param Proprietaire $proprietaire
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Proprietaire $proprietaire, Request $request)
    {
        return $this->json($proprietaire, 200);
    }

    /**
     * @Route("/update/{id}", name="update", methods="POST")
     */
    public function update(Proprietaire $proprietaire, Request $request)
    {
        $data = $request->request;
        $data = $data->all();
        $proprietaire->setNomProprietaire($data['nomProprietaire'])
            ->setNumTelephone($data['numTelephone'])
            ->setAdresse($data['adresse'])
            ->setAdresse($data['adresse'])
            ->setAutreContact($data['autreContact']);
        $this->em->persist($proprietaire);
        $this->em->flush();
        return $this->redirectToRoute('proprietaire');
    }
    /**
     * @Route("/proprietaire_add", name="addProprietaire")
     */
    public function add(Request $request)
    {
        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($proprietaire);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('proprietaire');
        }
        return $this->render('proprietaire/add.html.twig', [
            'proprietaire' => $proprietaire,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/proprietaire_delete", name="deleteProprietaire", methods="DELETE")
     * @param Proprietaire $proprietaire
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Proprietaire $proprietaire, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $proprietaire->getId(), $request->get('_token'))) {
            $this->em->remove($proprietaire);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimée avec succès');
        }
        return $this->redirectToRoute('proprietaire');
    }
}
