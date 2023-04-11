<?php

declare(strict_types=1);

namespace App\DTO;


use Nette\Database\Table\ActiveRow;

final class BasketItem
{
    private string $productId;

    private int $quantity;

    private string $name;

    private float $price;

    public function __construct(
        ActiveRow $product,
    ) {
        $this->quantity = 0;

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
    }

    public function addQuantity(int $quantity): void
    {
        $this->quantity += $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function subQuantity(int $quantity): void
    {
        if ($quantity > $this->quantity) {
            throw new \UnexpectedValueException('Quantity is greater than current quantity');
        }

        $this->quantity -= $quantity;
    }
}
