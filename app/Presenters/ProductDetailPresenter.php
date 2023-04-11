<?php

declare(strict_types=1);

namespace App\Presenters;

use Symfony\Component\Uid\Uuid;


final class ProductDetailPresenter extends BasePresenter
{
    use Trait\AddToBasketTrait;

    public function renderDefault(string $id): void
    {
        try {
            $id = Uuid::fromBase32($id);

            $this->template->product = $this->database->table('product')->get($id);
        } catch (\Throwable) {
            $this->error();
        }
    }
}
