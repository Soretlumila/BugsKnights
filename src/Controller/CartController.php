<?php
 
namespace App\Controller;
 
use App\Repository\CardsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Inventory;
use App\Repository\InventoryRepository;
use App\Entity\User;
 
class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, CardsRepository $cardsRepository): Response
    {
        $cart = $session->get('cart', []);
 
        $cartData = [];
        $total = 0;
 
        foreach ($cart as $id => $quantity) {
            $card = $cardsRepository->find($id);
 
            if ($card) {
                $subtotal = $card->getPrice() * $quantity;
 
                $cartData[] = [
                    'card' => $card,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
 
                $total += $subtotal;
            }
        }
 
        return $this->render('cart/index.html.twig', [
            'items' => $cartData,
            'total' => $total,
        ]);
    }
 
    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        if(!isset( $cart[$id])){
            $cart[$id] = 1; 
        }
       
 
        $session->set('cart', $cart);
 
        return $this->redirectToRoute('app_cart');
    }
 
    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
 
        unset($cart[$id]);
 
        $session->set('cart', $cart);
 
        return $this->redirectToRoute('app_cart');
    }
 
    #[Route('/cart/clear', name: 'cart_clear')]
    public function clear(SessionInterface $session): Response
    {
        $session->remove('cart');
 
        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/confirm', name: 'cart_confirm')]
    public function confirm( 
        SessionInterface $session, CardsRepository $cardsRepository, EntityManagerInterface $entityManager
    ) : Response {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login'); }

    $cart = $session->get('cart', []);

    foreach ($cart as $id => $quantity) {
        $card = $cardsRepository->find($id);

        if ($card) {
            $alreadyOwned = $entityManager->getRepository(Inventory::class)->findOneBy([
                'user' => $user,
                'cards' => $card,
            ]);

            if (!$alreadyOwned) {
                $inventory = new Inventory();
                $inventory->setUser($user);
                $inventory->setCards($card);
                $entityManager->persist($inventory);
            }
        }
    }

    $entityManager->flush();
    $session->remove('cart'); // vide le panier

    $this->addFlash('success', 'Commande confirmée ! Vos cartes ont été ajoutées à votre inventaire.');

    return $this->redirectToRoute('app_product');
}

}