<?php

namespace app\models\tables;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "servers".
 *
 * @property int $id
 * @property int|null $rate_id
 * @property int|null $user_id
 *
 * @property Rates $rate
 */
class Servers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate_id', 'user_id'], 'integer'],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rates::className(), 'targetAttribute' => ['rate_id' => 'id']],
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
        ];
    }

    /**
     * Gets query for [[Rate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRate()
    {
        return $this->hasOne(Rates::className(), ['id' => 'rate_id']);
    }

    // Получаем все серверы с таблицей тарифов

    public function getServersWithRates(){
        $orderQuery = (new Query())
            ->select('servers.id, servers.date, servers.order_id, rates.name AS Rate, user.email')
            ->from('yii_test.servers')
            ->join('LEFT JOIN', 'user', 'user.id = servers.user_id')
            ->join('LEFT JOIN', 'rates', 'rates.id = servers.rate_id');

        return $orderQuery;
    }

    // Получаем серверы для пользователя
    public function getServersByUserId($user_id){
        $serverQuery = (new Query())
            ->select('servers.id, servers.date, rates.name AS Rate')
            ->from('yii_test.servers')
            ->join('LEFT JOIN', 'rates', 'rates.id = servers.rate_id')
            ->where("user_id = $user_id");

        return $serverQuery;
    }

    // Создаём запись о сервере
    public function setServer($rate_id, $user_id, $order_id)
    {
        $this->rate_id = $rate_id;
        $this->user_id = $user_id;
        $this->order_id = $order_id;
        $this->save();
    }
}
