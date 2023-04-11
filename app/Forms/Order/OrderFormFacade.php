<?php

declare(strict_types=1);

namespace App\Forms\Order;

use App\DTO\Basket;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;
use Symfony\Component\Uid\Uuid;

class OrderFormFacade
{
    public function __construct(
        private Basket $basket,
        private Explorer $database,
    ) {
    }

    public function formSucceeded(Form $form, OrderFormData $data): void
    {
        try {
            $this->database->transaction(function (Explorer $db) use ($data) {
                $order = $db->table('order')->insert(
                    [
                        'id' => Uuid::v4(),
                        'name' => $data->name,
                        'email' => $data->email,
                        'phone_number' => $data->phoneNumber,
                    ]
                );
                $items = [];
                foreach ($this->basket->getItems() as $item) {
                    $items[] = [
                        'order_id' => $order->id,
                        'line' => count($items),
                        'product_id' => $item->getProductId(),
                        'quantity' => $item->getQuantity(),
                    ];
                }
                $db->table('order_item')->insert($items);
            });

            $this->basket->clear();
        } catch (\Exception $e) {
            $form->addError('Nastala chyba při ukládání objednávky.');
        }
    }

}