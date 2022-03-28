<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Form\ParkingType;
use App\Repository\ParkingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParkingController extends AbstractController
{
    /**
     * @var ParkingRepository
     */
    private $repository;

    public function __construct(ParkingRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/parking", name="parking")
     */
    public function index(Request $request)
    {
        $parking1 = $this->repository->findAll();

        $parking = new Parking();
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($parking);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('parking');
        }

        return $this->render('parking/index.html.twig', [
            'parking' => $parking1,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/parking/{id}/edit", name="editParking", methods="GET|POST")
     * @param Parking $parking
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Parking $parking, Request $request)
    {
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien editée avec succès');
            return $this->redirectToRoute('approchement');
        }
        return $this->render('parking/edit.html.twig', [
            'parking' => $parking,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/parking/{id}", name="deleteParking", methods="DELETE")
     * @param Parking $parking
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Parking $parking, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $parking->getId(), $request->get('_token'))) {
            $this->em->remove($parking);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimée avec succès');
        }
        return $this->redirectToRoute('$parking');
    }

    /**
     * @Route("parking/{id}", name="parking_show")
     */
    public function show(Parking $parking)
    {
        $form = $this->createForm(ParkingType::class, $parking);

        if ($form->isSubmitted() && $form->isValid()) {
        }
        return $this->render('parking/show.html.twig', [
            'parking' => $parking,
        ]);
    }
}
