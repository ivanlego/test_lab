<?php

use yii\db\Migration;

class m230925_081539_create_items_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('items', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'category' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
            'currency' => $this->string(3)->notNull()
        ]);

        $this->createIndex(
            'idx-item-category_id',
            'items',
            'category'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%items}}');
    }
}
