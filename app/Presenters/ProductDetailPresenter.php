<?php

declare(strict_types=1);

namespace App\Presenters;


final class ProductDetailPresenter extends BasePresenter
{
    use Trait\AddToBasketTrait;

    public function renderDefault(string $id): void
    {
        try {
            $this->template->product = $this->productRepository->get($id);
        } catch (\Throwable) {
            $this->error();
        }
    }
}
