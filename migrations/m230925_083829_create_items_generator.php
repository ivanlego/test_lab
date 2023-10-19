<?php

use yii\db\Migration;
use Faker\Factory;

class m230925_083829_create_items_generator extends Migration
{
    private int $itemsCount = 400000;

    private int $chunkSize = 1000;

    public function safeUp()
    {
        $faker = Faker\Factory::create();
        $fields = ['name', 'category', 'price', 'currency'];

        for ($i = 0; $i < $this->itemsCount; $i++) {
            $items[] = [
                $faker->realTextBetween(10, 30),
                rand(1, 10),
                rand(1, 10000),
                rand(0, 1) ? 'EUR' : 'USD'
            ];

            if (count($items) === $this->chunkSize) {
                $this->batchInsert('items',
                    $fields,
                    $items
                );
                $items = [];
            }
        }

    }

    public function safeDown()
    {
        $this->truncateTable('items');
    }
}
