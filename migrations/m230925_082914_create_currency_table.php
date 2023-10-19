<?php

use yii\db\Migration;

class m230925_082914_create_currency_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'currency' => "ENUM('EUR', 'USD')",
            'value' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-currency-date',
            'currency',
            'date'
        );
    }


    public function safeDown()
    {
        $this->dropTable('currency');
    }
}
