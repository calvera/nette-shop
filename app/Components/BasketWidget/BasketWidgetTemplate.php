<?php

declare(strict_types=1);

namespace App\Components\BasketWidget;

use Nette\Bridges\ApplicationLatte\Template;

final class BasketWidgetTemplate extends Template
{
    public int $itemsCount;

    public float $amount;
}
