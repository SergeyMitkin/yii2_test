<?php

use yii\db\Migration;

/**
 * Class m210206_212241_add_position_order_id_to_servers_table
 */
class m210206_212241_add_position_order_id_to_servers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('servers', 'order_id', $this->integer(11));
        // add foreign key for table `servers`
        $this->addForeignKey(
            'fk_servers_orders',
            'servers',
            'order_id',
            'orders',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_servers_orders', 'servers');
        $this->dropColumn('servers', 'order_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210206_212241_add_position_order_id_to_servers_table cannot be reverted.\n";

        return false;
    }
    */
}