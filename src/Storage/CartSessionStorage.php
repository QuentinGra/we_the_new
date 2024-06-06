<?php

namespace App\Storage;

use App\Entity\Order\Order;
use App\Repository\Order\OrderRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSessionStorage
{
    private const CART_SESSION_KEY = 'cart_id';

    public function __construct(
        private RequestStack $requestStack,
        private OrderRepository $orderRepo,
    ) {
    }

    public function getCart(): ?Order
    {
        return $this->orderRepo->findOneBy([
            'id' => $this->getSession()->get(self::CART_SESSION_KEY),
            'status' => Order::STATUS_CART,
        ]);
    }

    public function setCart(Order $order): void
    {
        $this->getSession()->set(self::CART_SESSION_KEY, $order->getId());
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
