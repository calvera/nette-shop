<?php

declare(strict_types=1);

namespace App\Presenters;


final class BasketPresenter extends BasePresenter
{
    use Trait\AddToBasketTrait;
    use Trait\OrderTrait;
}
