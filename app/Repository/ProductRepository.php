<?php

declare(strict_types=1);

namespace App\Repository;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\Utils\Paginator;

class ProductRepository
{

    public function __construct(
        private Explorer $database,
    ) {
    }

    public function get(string $id): ActiveRow
    {
        return $this->database->table('product')->get($id);
    }

    public function count(): int
    {
        return $this->database->table('product')->count();
    }

    public function list(Paginator $paginator): Selection
    {
        return $this->database->table('product')
            ->limit($paginator->getItemsPerPage(), $paginator->getOffset());
    }
}