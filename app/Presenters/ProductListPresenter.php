<?php

declare(strict_types=1);

namespace App\Presenters;


use Nette\Utils\Paginator;

final class ProductListPresenter extends BasePresenter
{
    use Trait\AddToBasketTrait;

    private const ITEMS_PER_PAGE = 2;

    public function renderDefault(int $page = 1): void
    {
        $count = $this->database
            ->table('product')->count();

        $paginator = new Paginator;
        $paginator->setItemCount($count);
        $paginator->setItemsPerPage(self::ITEMS_PER_PAGE);
        $paginator->setPage($page);

        $this->template->products = $this->database
            ->table('product')
            ->order('created_at DESC')
            ->page($page, self::ITEMS_PER_PAGE);

        $this->template->paginator = $paginator;
    }
}
