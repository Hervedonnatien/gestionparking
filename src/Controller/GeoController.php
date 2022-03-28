<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GeoController extends AbstractController
{
    /**
     * @Route("/geo", name="geo")
     */
    public function index()
    {
        return $this->render('geo/index.html.twig', [
            'controller_name' => 'GeoController',
        ]);
    }
}
