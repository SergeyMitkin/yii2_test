<?php

namespace app\models\tables;

use app\models\User;


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
        $rate = $this->rate;

        $this->save();
    }

    // Принимаем заказы
    public function confirmOrders($id_array){

        // Так как EVENT_AFTER_UPDATE при updateAll не работает, отдельно обновляем статус каждого заказа
        for ($i=0; $i<count($id_array); $i++){
            $order = $this::findOne($id_array[$i]);
            $order->status = 1;
            $order->save();
        }
    }

    // Отменяем заказы
    public function cancelOrders($id_array){

        $this::deleteAll(['in', 'id',  $id_array]);
    }

    // Получаем тариф
    public function getRate(){
        return $this->hasOne(Rates::class, ['id' => 'rate_id']);
    }

    // Получаем пользователя
    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    // Получаем сервер
    public function getServer(){
        return $this->hasOne(Servers::class, ['id' => 'server_id']);
    }

}
