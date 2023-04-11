<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\BasketWidget\BasketWidgetControl;
use App\Components\BasketWidget\BasketWidgetControlFactory;
use App\DTO\Basket;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

class BasePresenter extends Presenter
{
    #[Inject]
    public BasketWidgetControlFactory $basketWidgetComponentFactory;

    #[Inject]
    public Basket $basket;

    protected function createComponentBasketWidget(): BasketWidgetControl
    {
        return $this->basketWidgetComponentFactory->create();
    }

    public function beforeRender(): void
    {
        parent::beforeRender();
        $this->template->basket = $this->basket;
    }
}
