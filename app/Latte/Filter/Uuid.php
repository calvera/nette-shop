<?php

declare(strict_types=1);

namespace App\Latte\Filter;

class Uuid
{
    public function uuid(string|\Symfony\Component\Uid\Uuid $id): string
    {
        if (is_string($id)) {
            $id = \Symfony\Component\Uid\Uuid::fromString($id);
        }

        return $id->toBase32();
    }
}