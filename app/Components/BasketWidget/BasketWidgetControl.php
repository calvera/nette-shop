<?php

declare(strict_types=1);

namespace App\Components\BasketWidget;

use App\DTO\Basket;
use Nette\Application\UI\Control;

/**
 * @property-read BasketWidgetTemplate $template
 */
final class BasketWidgetControl extends Control
{
    public function __construct(private Basket $basket)
    {
    }


    public function render(): void
    {
        $this->template->setFile(__DIR__.'/BasketWidgetControl.latte');
        $this->template->itemsCount = count($this->basket->getItems());
        $this->template->amount = $this->basket->getTotalPrice();
        $this->template->render();
    }

    public function handleClean(): void
    {
        $this->basket->clear();
        $this->redrawControl();
        $this->presenter->redrawControl('productList');
        $this->presenter->redrawControl('productDetail');
        $this->presenter->payload->postGet = true;
        $this->presenter->payload->url = $this->link('this');
    }
}
