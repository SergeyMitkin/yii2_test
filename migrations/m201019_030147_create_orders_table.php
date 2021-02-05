<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m201019_030147_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'rate_id' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->tinyInteger(),
            'date' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()'))
        ]);

        $this->addForeignKey("fk_orders_user", "orders", "user_id", "user", "id");
        $this->addForeignKey("fk_orders_rates", "orders", "rate_id", "rates", "id");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
