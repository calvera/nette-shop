<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\AddToBasketButton\AddToBasketButtonControlFactory;
use Nette\Application\UI\Multiplier;
use Nette\Database\Explorer;
use Symfony\Component\Uid\Uuid;


final class ProductListPresenter extends AppPresenter
{
    public function __construct(
        private Explorer $database,
        private AddToBasketButtonControlFactory $addToBasketButtonControlFactory,
    ) {
        parent::__construct();
    }

    public function renderDefault(): void
    {
        $this->template->products = $this->database
            ->table('product')
            ->order('created_at DESC')
            ->limit(5);
    }


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
