<?php

declare(strict_types=1);

namespace App\Presenters;


use App\Repository\ProductRepository;
use Nette\Utils\Paginator;

final class ProductListPresenter extends BasePresenter
{
    use Trait\AddToBasketTrait;

    private const ITEMS_PER_PAGE = 2;

    public function __construct(
        private ProductRepository $productRepository,
    ) {
        parent::__construct();
    }


    public function renderDefault(int $page = 1): void
    {
        $paginator = new Paginator;
        $paginator->setItemCount($this->productRepository->count());
        $paginator->setItemsPerPage(self::ITEMS_PER_PAGE);
        $paginator->setPage($page);

        $this->template->paginator = $paginator;

        $this->template->products = $this->productRepository->list($paginator);
    }
}
