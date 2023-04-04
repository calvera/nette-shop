<?php

declare(strict_types=1);

namespace App\Components\AddToBasketButton;

use App\DTO\BasketItem;
use Latte;
use Nette;

final class AddToBasketButtonTemplate extends Nette\Bridges\ApplicationLatte\Template
{
    public BasketItem|null $item;

    #[Latte\Attributes\TemplateFunction]
    public function hasItem(): bool
    {
        return $this->item !== null;
    }
}
