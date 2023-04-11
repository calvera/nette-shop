<?php

declare(strict_types=1);

namespace App\Presenters\Trait;

use App\Forms\OrderFormFactory;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

trait OrderTrait
{

    #[Inject]
    public OrderFormFactory $formFactory;

    protected function createComponentOrderForm(): Form
    {
        assert($this instanceof Presenter);

        return $this->formFactory->create($this);
    }
}