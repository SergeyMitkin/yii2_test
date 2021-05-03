<?php

use yii\db\Migration;

/**
 * Handles the creation of column 'description' to 'rates' table.
 */
class m210503_095205_create_description_column_to_rates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('rates', 'description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('rates', 'description');
    }
}
