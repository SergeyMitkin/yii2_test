<?php

namespace app\models\filters;

use app\models\tables\Rates;
use phpDocumentor\Reflection\Types\Null_;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Servers;
use Yii;

/**
 * AccountServersFilter represents the model behind the search form of `app\models\tables\Servers`.
 */
class AccountServersFilter extends Servers
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
    public function search($params)
    {

        $query = Servers::find();

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
            'servers.id' => $this->id,
        ])
        ->andFilterWhere(['like', 'date', $this->date])
        ->andFilterWhere(['like', Rates::tableName().'.ru_name', $this->rate_name])
        ->andFilterWhere(['like', Rates::tableName().'.en_name', $this->rate_name])
        ->andFilterWhere(['user_id' => \Yii::$app->user->identity->id]);

        return $dataProvider;
    }
}
