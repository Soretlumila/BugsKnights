<?php

namespace App\Controller;

use App\Repository\CardsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
 
final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(CardsRepository $cardsRepository): Response
    {
        // page initiale
        $cards = $cardsRepository->findAll();
 
        return $this->render('product/index.html.twig', [
            'cards' => $cards,
        ]);
    }
 
    #[Route('/product/filter/{game}', name: 'app_product_filter')]
    public function filter(CardsRepository $cardsRepository, string $game): JsonResponse
    {
        if ($game === 'all') {
            $cards = $cardsRepository->findAll();
        } else {
            $cards = $cardsRepository->findBy(['game' => $game]);
        }
 
        // transforme en tableau simple pour le JSON
        $data = [];
        foreach ($cards as $card) {
            $data[] = [
                'name' => $card->getName(),
                'game' => $card->getGame(),
                'areas' => $card->getAreas(),
                'price' => $card->getPrice(),
                'picture' => $card->getPicture(),
            ];
        }
 
        return new JsonResponse($data);
    }
}
