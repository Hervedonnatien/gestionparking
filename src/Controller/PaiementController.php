<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Form\PaiementType;
use function PHPSTORM_META\type;
use App\Repository\PaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

/**
 * @Route("/admin")
 */
class PaiementController extends AbstractController
{
    /**
     * @var PaiementRepository
     */
    private $repository;

    public function __construct(PaiementRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/paiement", name="paiement")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $paiement1 = $this->repository->findAll();
       
        $paiement = new Paiement();
        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($paiement);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajouté avec succès');
            return $this->redirectToRoute('paiement');
        }
        return $this->render('paiement/index.html.twig', [
            'paiement' => $paiement1,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/paiement/{id}/edit", name="editPaiement", methods="GET|POST")
     * @param Paiement $paiement
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Paiement $paiement, Request $request)
    {
        return $this->json($paiement, 200);
    }

    /**
     * @Route("/update/{id}", name="update", methods="POST")
     */
    public function update(Paiement $paiement, Request $request)
    {
        $data = $request->request;
        $data = $data->all();
        $paiement->setDateDebut($data['dateDebut'])
            ->setDateFin($data['dateFin'])
            ->setModePaiement($data['modePaiement'])
            ->setMontant($data['montant'])
            ->setProprietaire($data['proprietaire']);
        $this->em->persist($paiement);
        $this->em->flush();
        return $this->redirectToRoute('paiement');
    }

    /**
     * @Route("/paiement_add", name="addPaiement")
     * 
     */
    public function add(Request $request)
    {
        $paiement = new Paiement();
        $form = $this->createForm(PaiementType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($paiement);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('paiement');
        }
        return $this->render('client/add.html.twig', [
            'paiement' => $paiement,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/paiement/{id}", name="deletePaiement", methods="DELETE")
     * @param Paiement $client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Paiement $paiement, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $paiement->getId(), $request->get('_token'))) {
            $this->em->remove($paiement);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimée avec succès');
        }
        return $this->redirectToRoute('paiement');
    }
}
