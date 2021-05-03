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
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание',
            'name' => 'Тариф',
            'price' => 'Цена',
        ];
    }
}
