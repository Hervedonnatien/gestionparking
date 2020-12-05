<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

use function PHPSTORM_META\type;

class ClientController extends AbstractController
{
    /**
     * @var ClientRepository
     */
    private $repository;

    public function __construct(ClientRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/client", name="client")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $client1 = $this->repository->findAll();

        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($client);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('client');
        }

        return $this->render('client/index.html.twig', [
            'client' => $client1,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/client/{id}/edit", name="editClient", methods="GET|POST")
     * @param Client $client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Client $client, Request $request)
    {
        return $this->json($client, 200);
    }

    /**
     * @Route("/updates/{id}", name="updates", methods="POST")
     */
    public function update(Client $client, Request $request)
    {

        $data = $request->request;
        $data = $data->all();
        $client->setNomClient($data['nomClient'])
            ->setTypeClient($data['typeClient'])
            ->setContactClient($data['contactClient'])
            ->setAdresse($data['adresse'])
            ->setNumContrat($data['numContrat']);
        $this->em->persist($client);
        $this->em->flush();
        return $this->redirectToRoute('client');
    }

    /**
     * @Route("/client/{id}", name="deleteClient", methods="DELETE")
     * @param Client $client
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Client $client, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->get('_token'))) {
            $this->em->remove($client);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimée avec succès');
        }
        return $this->redirectToRoute('client');
    }

    /**
     * @Route("/client_add", name="addClient")
     */
    public function add(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($client);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajoutée avec succès');
            return $this->redirectToRoute('client');
        }
        return $this->render('client/add.html.twig', [
            'client' => $client,
            'form' => $form->createView()
        ]);
    }
}
