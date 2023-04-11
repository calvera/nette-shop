<?php

declare(strict_types=1);

namespace App\Forms\Order;

use Nette\Application\UI\Form;

class OrderFormFactory
{
    public function __construct(
        private OrderFormFacade $facade,
    ) {
    }

    public function create(): Form
    {
        $form = new Form;

        $form->addText('name', 'Jméno:')
            ->setRequired('Zadejte prosím jméno.')
            ->addRule(Form::MAX_LENGTH, 'Jméno může mít maximálně %d znaků.', 50);

        $form->addEmail('email', 'E-mail:')
            ->setRequired('Zadejte prosím e-mail.')
            ->addRule(Form::MAX_LENGTH, 'Jméno může mít maximálně %d znaků.', 256);

        $form->addText('phoneNumber', 'Telefon:')
            ->setRequired('Zadejte prosím telefon.')
            ->addRule(Form::MAX_LENGTH, 'Jméno může mít maximálně %d znaků.', 50);

        $form->addSubmit('send', 'Objednat');

        $form->onSuccess[] = [$this->facade, 'formSucceeded'];

        return $form;
    }
}