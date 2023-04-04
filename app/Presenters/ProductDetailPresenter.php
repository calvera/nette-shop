<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\AddToBasketButton\AddToBasketButtonControl;
use App\Components\AddToBasketButton\AddToBasketButtonControlFactory;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Symfony\Component\Uid\Uuid;


final class ProductDetailPresenter extends AppPresenter
{
    private ActiveRow $product;

    public function __construct(
        private Explorer $database,
        private AddToBasketButtonControlFactory $addToBasketButtonControlFactory,
    ) {
        parent::__construct();
    }

    public function actionDefault(string $id): void
    {
        try {
            $id = Uuid::fromBase32($id);
            $this->product = $this->database->table('product')->get($id);
        } catch (\Throwable) {
            $this->error();
        }
    }

    public function renderDefault(string $id): void
    {
        $this->template->product = $this->product;
    }

    protected function createComponentAddToBasket(): AddToBasketButtonControl
    {
        $component = $this->addToBasketButtonControlFactory->create($this->product);
        $component->onChange[] = function () {
            $this->payload->postGet = true;
            $this->payload->url = $this->link('this');
            $this['basketWidget']->redrawControl();
        };

        return $component;
    }

}
