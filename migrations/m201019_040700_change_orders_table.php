<?php

use yii\db\Migration;

/**
 * Class m201019_040700_change_orders_table
 */
class m201019_040700_change_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('orders', 'status', $this->tinyInteger(4)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('orders', 'status', $this->tinyInteger());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201019_040700_change_orders_table cannot be reverted.\n";

        return false;
    }
    */
}
