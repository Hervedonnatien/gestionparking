<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

use function PHPSTORM_META\type;

class ContratController extends AbstractController
{
    /**
     * @var ContratRepository
     */
    private $repository;

    public function __construct(ContratRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/contrat", name="contrat")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $contrat1 = $this->repository->findAll();

        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contrat);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('contrat');
        }
        return $this->render('contrat/index.html.twig', [
            'contrat' => $contrat1,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/contrat/{id}/edit", name="editContrat", methods="GET|POST")
     * @param Contrat $contrat
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Contrat $contrat, Request $request)
    {
        return $this->json($contrat, 200);
    }

    /**
     * @Route("/update/{id}", name="update", methods="POST")
     */
    public function update(Contrat $contrat, Request $request)
    {
        $data = $request->request;
        $data = $data->all();
        $contrat->setNumContrat($data['numContrat'])
            ->setDateDebut($data['dateDebut'])
            ->setDateFin($data['dateFin']);
        $this->em->persist($contrat);
        $this->em->flush();
        return $this->redirectToRoute('contrat');
    }

    /**
     * @Route("/contrat_add", name="addContrat")
     */
    public function add(Request $request)
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contrat);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('contrat');
        }
        return $this->render('contrat/add.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/contrat/{id}", name="deleteContrat", methods="DELETE")
     * @param Contrat $contrat
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Contrat $contrat, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $contrat->getId(), $request->get('_token'))) {
            $this->em->remove($contrat);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimée avec succès');
        }
        return $this->redirectToRoute('contrat');
    }
}
