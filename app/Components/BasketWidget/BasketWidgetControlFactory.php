<?php

declare(strict_types=1);

namespace App\Components\BasketWidget;

interface BasketWidgetControlFactory
{
	public function create(): BasketWidgetControl;
}
