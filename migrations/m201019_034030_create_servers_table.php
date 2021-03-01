<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%servers}}`.
 */
class m201019_034030_create_servers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%servers}}', [
            'id' => $this->primaryKey(),
            'rate_id' => $this->integer(),
            'user_id' => $this->integer(),
            'date' => $this->timestamp()->defaultValue(new \yii\db\Expression('NOW()'))
        ]);

        $this->addForeignKey("fk_servers_user", "servers", "user_id", "user", "id");
        $this->addForeignKey("fk_servers_rates", "servers", "rate_id", "rates", "id");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%servers}}');
    }
}
