<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\BasketWidget\BasketWidgetControl;
use App\Components\BasketWidget\BasketWidgetControlFactory;
use Nette;

class AppPresenter extends Nette\Application\UI\Presenter
{
    #[Nette\DI\Attributes\Inject]
    public BasketWidgetControlFactory $basketWidgetComponentFactory;

    protected function createComponentBasketWidget(): BasketWidgetControl
    {
        return $this->basketWidgetComponentFactory->create();
    }
}
