<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rates}}`.
 */
class m201019_025828_create_rates_table extends Migration
{
    public $table = "{{%rates}}";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rates}}', [
            'id' => $this->primaryKey(),
            'ru_name' => $this->string(),
            'ru_description' => $this->text(),
            'en_name' => $this->string(),
            'en_description' => $this->text(),
            'price' => $this->decimal(10,2)
        ]);

        $this->insert($this->table, array('ru_name'=>'Тариф 1', 'ru_description' => 'Описание 1', 'en_name' => 'Rate 1', 'en_description' => 'Description 1', 'price'=>'1'));
        $this->insert($this->table, array('ru_name'=>'Тариф 2', 'ru_description' => 'Описание 2', 'en_name' => 'Rate 2', 'en_description' => 'Description 2', 'price'=>'2'));
        $this->insert($this->table, array('ru_name'=>'Тариф 3', 'ru_description' => 'Описание 3', 'en_name' => 'Rate 3', 'en_description' => 'Description 3', 'price'=>'3'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rates}}');
    }
}
