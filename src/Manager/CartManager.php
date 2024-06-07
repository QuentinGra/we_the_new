<?php

namespace App\Manager;

use App\Entity\Order\Order;
use App\Factory\OrderFactory;
use App\Repository\Order\OrderRepository;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class CartManager
{

    public function __construct(
        private EntityManagerInterface $em,
        private OrderFactory $orderFactory,
        private CartSessionStorage $cartSessionStorage,
        private Security $security,
        private OrderRepository $orderRepo,
    ) {
    }

    public function getCurrentCart(): Order
    {
        $cart = $this->cartSessionStorage->getCart();

        $user = $this->security->getUser();

        if (!$cart) {
            if ($user) {
                // Si l'utilisateur est connecté et qu'il n'y a pas de panier en session
                // on récupère le dernier panier enregistré en base
                $cart = $this->orderRepo->findLastCartByUser($user);
            }
            // Si on a un panier en session sans utilisateur
            // Et qu'on a un utilisateur de connecter
        } else if (!$cart->getUser() && $user) {
            $cart->setUser($user);

            // On récupère le dernier panier de l'utilisateur enregistré en base
            $cartDb = $this->orderRepo->findLastCartByUser($user);

            // Si l'utilisateur avait déjà un panier, on fusionne les paniers
            if ($cartDb) {
                $cart = $this->mergeCart($cartDb, $cart);
            }
        }

        return $cart ?? $this->orderFactory->create();
    }

    public function save(Order $order): void
    {
        $this->em->persist($order);
        $this->em->flush();

        $this->cartSessionStorage->setCart($order);
    }

    private function mergeCart(Order $cartDb, Order $cartSession): Order
    {
        foreach ($cartDb->getOrderItems() as $item) {
            $cartSession->addOrderItem($item);
        }

        $this->em->remove($cartDb);
        $this->em->flush();

        return $cartSession;
    }
}
