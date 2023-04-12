<?php

declare(strict_types=1);

use App\Repository\ProductRepository;
use Nette\Application\IPresenterFactory;
use Nette\Application\Responses\TextResponse;
use Nette\Bridges\ApplicationLatte\Template;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';

$productRepository = $container->getByType(ProductRepository::class);
$var = $productRepository->findAll()->fetch();

$id = $var->id;
$name = $var->name;

$presenterFactory = $container->getByType(IPresenterFactory::class);

$presenter = $presenterFactory->createPresenter('ProductDetail');
$presenter->autoCanonicalize = false;

$request = new Nette\Application\Request('ProductDetail', 'GET', ['id' => $id]);
$response = $presenter->run($request);

Assert::type(TextResponse::class, $response);
Assert::type(Template::class, $response->getSource());

$html = (string) $response->getSource();

$dom = Tester\DomQuery::fromHtml($html);
Assert::count(1, $dom->find('h2'));
$h2 = $dom->find('h2')[0];
Assert::equal($name, (string)$h2);