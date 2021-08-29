<?php

use yii\db\Migration;

/**
 * Class m210829_211901_create_create_server_trigger
 */

// При смене статуса заказа на 1 (принятый), добавляем запись в твблицу servers
class m210829_211901_create_create_server_trigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "
        CREATE TRIGGER create_server AFTER UPDATE ON orders
            FOR EACH ROW
            IF (NEW.status = 1) THEN
                INSERT INTO servers(rate_id, user_id, order_id) VALUES (OLD.rate_id, OLD.user_id, OLD.id);
            END IF;
        ";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = "DROP TRIGGER IF EXISTS create_server;";
        $this->execute($sql);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210829_211901_create_create_server_trigger cannot be reverted.\n";

        return false;
    }
    */
}
