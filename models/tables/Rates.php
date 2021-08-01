<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "rates".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $price
 */
class Rates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['ru_name'], 'string', 'max' => 50],
            [['ru_description'], 'string', 'max' => 250],
            [['en_name'], 'string', 'max' => 50],
            [['en_description'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ru_name' => 'Тариф',
            'ru_description' => 'Описание',
            'en_name' => 'Name (English)',
            'en_description' => 'Description (English)',
            'price' => 'Цена',
        ];
    }
}
