<?php

namespace app\models\tables;

use app\models\User;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int|null $rate_id
 * @property string|null $date
 * @property int|null $status
 * @property int|null $user_id
 * @property Rates $rate
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate_id', 'user_id', 'status'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rate_id' => 'Rate ID',
            'user_id' => 'User ID',
            'date' => 'Дата и время',
            'status' => 'Статус',
        ];
    }

    // Создаём заказ
    public function setOrder($rate_id, $user_id){

        $this->rate_id = $rate_id;
        $this->user_id = $user_id;
        $this->save();
    }

    // Принимаем заказ
    public function confirmOrder($order_id){

        $order = $this::findOne($order_id);
        $order->status = 1;

        if ($order->save()){
            return true;
        }
    }

    // Отменяем заказ
    public function cancelOrder($order_id){

        $order = $this::findOne($order_id);
        if ($order->delete()){
            return true;
        };
    }

    // Получаем тариф
    public function getRate(){
        return $this->hasOne(Rates::class, ['id' => 'rate_id']);
    }

    // Получаем пользователя
    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
