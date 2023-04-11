<?php

declare(strict_types=1);

namespace App\Presenters\Trait;

use App\Components\AddToBasketButton\AddToBasketButtonControlFactory;
use App\Repository\ProductRepository;
use Nette\Application\UI\Multiplier;
use Nette\DI\Attributes\Inject;

trait AddToBasketTrait
{
    #[Inject]
    public ProductRepository $productRepository;

    #[Inject]
    public AddToBasketButtonControlFactory $addToBasketButtonControlFactory;

    protected function createComponentAddToBasket(): Multiplier
    {
        return new Multiplier(
            function (string $productId) {
                $product = $this->productRepository->get($productId);
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