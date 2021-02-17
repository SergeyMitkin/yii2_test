<?php

namespace app\models\filters;

use app\models\tables\Rates;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Servers;

/**
 * ServersFilter represents the model behind the search form of `app\models\tables\Servers`.
 */
class ServersFilter extends Servers
{
    public $rate_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rate_id'], 'integer'],
            [['date', 'rate_name'], 'safe'],
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
    public function search($params, $user_id)
    {

        $query = Servers::find();
        $query->joinWith(['rate']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['rate_name'] = [
            'asc' => [Rates::tableName().'.name' => SORT_ASC],
            'desc' => [Rates::tableName().'.name' => SORT_DESC],
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
            //'date' => $this->date,
            'order_id' => $this->order_id,
        ])
        ->andFilterWhere(['like', 'date', $this->date])
        ->andFilterWhere(['like', Rates::tableName().'.name', $this->rate_name])
        ;

        // Выводим заказы только для авторизованного пользователя
        $query->andFilterWhere(['user_id' => $user_id]);

        return $dataProvider;
    }
}
