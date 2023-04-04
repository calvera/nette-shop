<?php

declare(strict_types=1);

namespace App\Components\AddToBasketButton;

use App\DTO\Basket;
use App\DTO\BasketItem;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Database\Table\ActiveRow;

/**
 * @property-read AddToBasketButtonTemplate $template
 * @method void onChange()
 */
final class AddToBasketButtonControl extends Control
{
    /** @var callable[] */
    public array $onChange = [];

    public function __construct(
        private Basket $basket,
        private ActiveRow $product,
    ) {
    }

    public function render(): void
    {
        $this->template->setFile(__DIR__.'/AddToBasketButtonControl.latte');
        $this->template->item = $this->getItem();
        $this->template->render();
    }

    public function handleAdd(): void
    {
        $this->redrawControl();
        $this->addItem();
        $this->onChange();
    }

    protected function createComponentForm(): Form
    {
        $form = new Form();

        $subtract = $form->addSubmit('subtract', '–');
        $subtract->onClick[] = function (): void {
            $this->redrawControl();
            $this->removeItem();
            $this->onChange();
        };

        $add = $form->addSubmit('add', '+');
        $add->onClick[] = function (): void {
            $this->redrawControl();
            $this->addItem();
            $this->onChange();
        };

        return $form;
    }

    private function getItem(): ?BasketItem
    {
        return $this->basket->getItem($this->product);
    }

    private function addItem(): void
    {
        $this->basket->add($this->product);
    }

    private function removeItem(): void
    {
        $this->basket->subtract($this->product);
    }
}
