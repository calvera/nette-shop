<?php

declare(strict_types=1);

namespace App\Forms;

use App\DTO\Basket;
use JetBrains\PhpStorm\NoReturn;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Database\Explorer;

class OrderFormFactory
{
    private Presenter $presenter;

    public function __construct(
        private Explorer $database,
        private Basket $basket,
    ) { }

    public function create(Presenter $presenter): Form
    {
        $this->presenter = $presenter;

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

        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    #[NoReturn]
    public function formSucceeded(Form $form, $data): void
    {
        $this->presenter->flashMessage('Objednavka úspěšně odeslana.');
        $this->basket->clear();
        $this->presenter->redirect('Home:');
    }
}