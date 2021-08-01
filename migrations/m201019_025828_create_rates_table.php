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
            'name' => $this->string(),
            'description' => $this->text(),
            'en_name' => $this->string(),
            'en_description' => $this->text(),
            'price' => $this->decimal(10,2)
        ]);

        $this->insert($this->table, array('name'=>'Тариф 1', 'description' => 'Описание 1', 'en_name' => 'Rate 1', 'en_description' => 'Description 1', 'price'=>'1'));
        $this->insert($this->table, array('name'=>'Тариф 2', 'description' => 'Описание 2', 'en_name' => 'Rate 2', 'en_description' => 'Description 2', 'price'=>'2'));
        $this->insert($this->table, array('name'=>'Тариф 3', 'description' => 'Описание 3', 'en_name' => 'Rate 3', 'en_description' => 'Description 3', 'price'=>'3'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rates}}');
    }
}
