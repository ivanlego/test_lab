<?php

use yii\db\Migration;

/**
 * Class m230925_091331_create_currency_generator
 */
class m230925_091331_create_currency_generator extends Migration
{
    private string $startDate = '2022-01-01';
    private string $endDate = '2023-07-01';

    private int $chunkSize = 100;
    public function safeUp()
    {
        $fields = ['date', 'currency', 'value'];
        $startDate = DateTime::createFromFormat('Y-m-d', $this->startDate);
        $endDate = DateTime::createFromFormat('Y-m-d', $this->endDate);
        $currencies = [];

        while ($startDate <= $endDate) {
            $currencies[] = [
                $startDate->format('Y-m-d'),
                rand(0, 1) ? 'EUR' : 'USD',
                rand(1, 100)
            ];
            $startDate->modify('+1 day');
        }

        $currencies = array_chunk($currencies,$this->chunkSize);

        foreach ($currencies as $currencyChunk) {
            $this->batchInsert(
                'currency',
                $fields,
                $currencyChunk
            );
        }
    }

    public function safeDown()
    {
        $this->truncateTable('currency');
    }
}
