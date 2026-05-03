<?php
namespace App\Controller;

use App\Repository\CardsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DetailsproductController extends AbstractController
{
    #[Route('/detailsproduct/{id}', name: 'app_detailsproduct')]
    public function index(int $id, CardsRepository $cardsRepository): Response
    {
        $card = $cardsRepository->find($id);

        if (!$card) {
            throw $this->createNotFoundException('Cards not founds');
        }

        return $this->render('detailsproduct/index.html.twig', [
            'card' => $card,
        ]);
    }
}