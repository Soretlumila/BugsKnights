<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InfoplusController extends AbstractController
{
    #[Route('/infoplus', name: 'app_infoplus')]
    public function index(): Response
    {
        return $this->render('infoplus/index.html.twig', [
            'controller_name' => 'InfoplusController',
        ]);
    }
}
