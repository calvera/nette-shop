<?php

declare(strict_types=1);

namespace App\Repository;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\Utils\Paginator;
use Symfony\Component\Uid\Uuid;

class ProductRepository
{

    public function __construct(
        private Explorer $database,
    ) {
    }

    public function count(): int
    {
        return $this->database->table('product')->count();
    }

    public function get(string|Uuid $id): ActiveRow
    {
        if (is_string($id)) {
            $id = Uuid::fromString($id);
        }

        return $this->database->table('product')->get($id);
    }

    public function list(Paginator $paginator): Selection
    {
        return $this->database->table('product')
            ->limit($paginator->getItemsPerPage(), $paginator->getOffset());
    }
}