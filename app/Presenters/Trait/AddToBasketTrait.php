<?php

declare(strict_types=1);

namespace App\Presenters\Trait;

use App\Components\AddToBasketButton\AddToBasketButtonControlFactory;
use Nette\Application\UI\Multiplier;
use Nette\Database\Explorer;
use Nette\DI\Attributes\Inject;
use Symfony\Component\Uid\Uuid;

trait AddToBasketTrait
{
    #[Inject]
    public Explorer $database;

    #[Inject]
    public AddToBasketButtonControlFactory $addToBasketButtonControlFactory;

    protected function createComponentAddToBasket(): Multiplier
    {
        return new Multiplier(
            function (string $productId) {
                $id = Uuid::fromBase32($productId);
                $product = $this->database->table('product')->get($id);
                $component = $this->addToBasketButtonControlFactory->create($product);
                $component->onChange[] = function () {
                    $this->payload->postGet = true;
                    $this->payload->url = $this->link('this');
                    $this['basketWidget']->redrawControl();
                };

                return $component;
            },
        );
    }

}