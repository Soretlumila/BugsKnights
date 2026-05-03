<?php
namespace App\Controller;

use App\Repository\InventoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CardsRepository;
final class InventoryController extends AbstractController
{

#[Route('/inventory', name: 'app_inventory')]
public function index(InventoryRepository $inventoryRepository, CardsRepository $cardsRepository): Response
{
    $user = $this->getUser();

    if (!$user) {
        return $this->redirectToRoute('app_login');
    }

    $inventories = $inventoryRepository->findBy(['user' => $user]);

    // Récupère les IDs possédés
    $ownedCardIds = [];
    foreach ($inventories as $inventory) {
        $ownedCardIds[] = $inventory->getCards()->getId();
    }

    // Toutes les cartes NON possédées
    $allCards = $cardsRepository->findAll();
    $notOwnedCards = array_filter($allCards, function($card) use ($ownedCardIds) {
        return !in_array($card->getId(), $ownedCardIds);
    });

    return $this->render('inventory/index.html.twig', [
        'inventories' => $inventories,
        'notOwnedCards' => $notOwnedCards,
    ]);
}
}