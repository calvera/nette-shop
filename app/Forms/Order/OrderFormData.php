<?php

declare(strict_types=1);

namespace App\Forms\Order;

class OrderFormData
{
    public function __construct(
        public string $name,
        public string $phoneNumber,
        public string $email,
    ) {
    }
}