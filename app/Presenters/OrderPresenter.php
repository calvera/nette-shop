<?php

declare(strict_types=1);

namespace App\Presenters;


use App\Forms\Order\OrderFormFactory;
use Nette\Application\UI\Form;

final class OrderPresenter extends BasePresenter
{
    public function __construct(
        private OrderFormFactory $formFactory,
    ) {
        parent::__construct();
    }


    protected function createComponentOrderForm(): Form
    {
        $form = $this->formFactory->create();

        $form->onSuccess[] = function () {
            $this->flashMessage('Objednavka byla ulozena');
            $this->redirect('Home:');
        };

        return $form;
    }
}
