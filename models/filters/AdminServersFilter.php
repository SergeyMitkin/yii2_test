<?php

namespace app\models\filters;

use app\models\tables\Orders;
use app\models\tables\Rates;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Servers;
use app\models\User;

/**
 * AccountServersFilter represents the model behind the search form of `app\models\tables\Servers`.
 */
class AdminServersFilter extends Servers
{
    public $rate_name;
    public $order_id;
    public $user_email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rate_id', 'order_id'], 'integer'],
            [['date', 'rate_name', 'user_email'], 'safe'],
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

        $query = Servers::find();
        $query->joinWith(['rate']);
        $query->joinWith(['order']);
        $query->joinWith(['user']);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['rate_name'] = [
            'asc' => [Rates::tableName().'.name' => SORT_ASC],
            'desc' => [Rates::tableName().'.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['order_id'] = [
            'asc' => [Orders::tableName().'.id' => SORT_ASC],
            'desc' => [Orders::tableName().'.id' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user_email'] = [
            'asc' => [User::tableName().'.email' => SORT_ASC],
            'desc' => [User::tableName().'.email' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'servers.id' => $this->id,
            'order_id' => $this->order_id
        ])
        ->andFilterWhere(['like', 'date', $this->date])
        ->andFilterWhere(['like', Rates::tableName().'.name', $this->rate_name])
        ->andFilterWhere(['like', User::tableName().'.email', $this->user_email]);

        return $dataProvider;
    }
}
