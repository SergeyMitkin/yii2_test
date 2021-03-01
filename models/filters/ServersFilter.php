<?php

namespace app\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Servers;
use app\models\tables\Rates;
use app\models\User;

/**
 * ServersFilter represents the model behind the search form of `app\models\tables\Servers`.
 */
class ServersFilter extends Servers
{
    public $rate_name;
    public $user_email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rate_id', 'user_id', 'order_id'], 'integer'],
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
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['date' => SORT_DESC]]
        ]);

        $dataProvider->sort->attributes['rate_name'] = [
            'asc' => [Rates::tableName().'.name' => SORT_ASC],
            'desc' => [Rates::tableName().'.name' => SORT_DESC],
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
            //'rate_id' => $this->rate_id,
            //'user_id' => $this->user_id,
            'order_id' => $this->order_id,
        ])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', Rates::tableName().'.name', $this->rate_name])
            ->andFilterWhere(['like', User::tableName().'.email', $this->user_email]);

        return $dataProvider;
    }
}
