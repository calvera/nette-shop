<?php

declare(strict_types=1);

namespace App\Presenters;


final class ProductListPresenter extends BasePresenter
{
    use Trait\AddToBasketTrait;

    public function renderDefault(): void
    {
        $this->template->products = $this->database
            ->table('product')
            ->order('created_at DESC')
            ->limit(5);
    }
}
