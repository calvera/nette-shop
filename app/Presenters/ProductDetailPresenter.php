<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Database\Table\ActiveRow;
use Symfony\Component\Uid\Uuid;


final class ProductDetailPresenter extends BasePresenter
{
    use Trait\AddToBasketTrait;

    private ActiveRow $product;

    public function actionDefault(string $id): void
    {
        try {
            $id = Uuid::fromBase32($id);
            $this->product = $this->database->table('product')->get($id);
            $this->template->product = $this->product;
        } catch (\Throwable) {
            $this->error();
        }
    }
}
