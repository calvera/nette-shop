<?php

declare(strict_types=1);

namespace App\Components\AddToBasketButton;

use Nette;

interface AddToBasketButtonControlFactory
{
    public function create(Nette\Database\Table\ActiveRow $product): AddToBasketButtonControl;
}
