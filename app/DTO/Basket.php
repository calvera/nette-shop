<?php

declare(strict_types=1);

namespace App\DTO;

use Nette\Database\Table\ActiveRow;
use Nette\Http\Session;
use Nette\Http\SessionSection;

class Basket
{
    private SessionSection $session;

    public function __construct(
        Session $session,
    ) {
        $this->session = $session->getSection(self::class);
    }

    public function add(ActiveRow $product, int $quantity = 1): void
    {
        $item = $this->getItem($product);
        if (!$item) {
            $item = new BasketItem($product);
            $item->addQuantity($quantity);
            $this->session->set('items', [
                ...$this->getItems(),
                $product->id => $item,
            ]);
        } else {
            $item->addQuantity($quantity);
        }
    }

    public function getItem(ActiveRow $product): ?BasketItem
    {
        return $this->getItems()[$product->id] ?? null;
    }

    /**
     * @return BasketItem[]
     */
    public function getItems(): array
    {
        $items = $this->session->get('items');
        if (!$items) {
            $this->session->set('items', []);
        }

        return $this->session->get('items');
    }

    public function clear(): void
    {
        $this->session->set('items', []);
    }

    public function getTotalPrice(): float
    {
        $totalPrice = 0;
        foreach ($this->getItems() as $item) {
            $totalPrice += $item->getPrice() * $item->getQuantity();
        }

        return $totalPrice;
    }

    public function isEmpty(): bool
    {
        return count($this->getItems()) === 0;
    }

    public function subtract(ActiveRow $product, int $quantity = 1): void
    {
        $item = $this->getItem($product);

        if (!$item) {
            throw new \UnexpectedValueException('Item not found in basket');
        }
        $item->subQuantity($quantity);
        if ($item->getQuantity() <= 0) {
            $this->remove($product);
        }
    }

    public function remove(ActiveRow $product): void
    {
        $newItems = $this->getItems();
        unset($newItems[$product->id]);

        $this->session->set('items', $newItems);
    }
}