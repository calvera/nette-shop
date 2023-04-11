<?php

declare(strict_types=1);

namespace App\Forms\Order;

use App\DTO\Basket;
use Nette\Application\UI\Form;

class OrderFormFacade
{
    public function __construct(
        private Basket $basket,
    ) {
    }

    public function formSucceeded(Form $form, $data): void
    {
        // TODO
        $this->basket->clear();
    }

}