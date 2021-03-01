<?php

use yii\db\Migration;

/**
 * Class m210226_182103_add_inique_index_to_order_id_column
 */
class m210226_182103_add_inique_index_to_order_id_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {

        $this->dropForeignKey(
            'servers_orders_id_fk',
            'servers'
        );

        // creates index for column `author_id`
        $this->createIndex(
            'servers_order_id_uindex',
            'servers',
            'order_id',
            $unique = true
        );

        $this->addForeignKey(
            'servers_orders_id_fk', 'servers', 'order_id', 'orders', 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {

        $this->dropForeignKey(
            'servers_orders_id_fk',
            'servers'
        );


        //DROP INDEX servers_order_id_uindex ON servers
        $this->dropIndex(
            'servers_order_id_uindex',
            'servers'
        );

        $this->addForeignKey(
            'servers_orders_id_fk', 'servers', 'order_id', 'orders', 'id'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210226_171026_create_unique_index_fk_servers_orders cannot be reverted.\n";

        return false;
    }
    */
}
