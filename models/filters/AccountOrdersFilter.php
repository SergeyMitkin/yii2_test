<?php

namespace app\models\filters;

use app\models\tables\Rates;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Orders;

/**
 * AccountServersFilter represents the model behind the search form of `app\models\tables\Servers`.
 */
class AccountOrdersFilter extends Orders
{
    public $rate_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rate_id'], 'integer'],
            [['date', 'rate_name', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Orders::find();
        $query->joinWith(['rate']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['rate_name'] = [
            'asc' => [Rates::tableName().'.ru_name' => SORT_ASC],
            'desc' => [Rates::tableName().'.ru_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['rate_name'] = [
            'asc' => [Rates::tableName().'.en_name' => SORT_ASC],
            'desc' => [Rates::tableName().'.en_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'orders.id' => $this->id,
            'status' => $this->status,
        ])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', Rates::tableName().'.ru_name', $this->rate_name])
            ->andFilterWhere(['like', Rates::tableName().'.en_name', $this->rate_name])
            ->andFilterWhere(['user_id' => \Yii::$app->user->identity->id]); // Выводим заказы только для авторизованного пользователя

        return $dataProvider;
    }
}
