<?php

declare(strict_types=1);

use Nette\Application\IPresenterFactory;
use Nette\Application\Responses\TextResponse;
use Nette\Bridges\ApplicationLatte\Template;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';

$presenterFactory = $container->getByType(IPresenterFactory::class);

$presenter = $presenterFactory->createPresenter('Order');
$presenter->autoCanonicalize = false;

$request = new Nette\Application\Request('Order', 'GET', ['page' => 1]);
$response = $presenter->run($request);

Assert::type(TextResponse::class, $response);
Assert::type(Template::class, $response->getSource());

$html = (string) $response->getSource();

$dom = Tester\DomQuery::fromHtml($html);
Assert::count(1, $dom->find('div.alert'));