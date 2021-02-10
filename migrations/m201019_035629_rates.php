<?php

use yii\db\Migration;

/**
 * Class m201019_035629_rates
 */
class m201019_035629_rates extends Migration
{
    public $table = "{{%rates}}";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert($this->table, array('name'=>'Тариф 1','price'=>'1'));
        $this->insert($this->table, array('name'=>'Тариф 2','price'=>'2'));
        $this->insert($this->table, array('name'=>'Тариф 3','price'=>'3'));

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable($this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201019_035629_rates cannot be reverted.\n";

        return false;
    }
    */
}
