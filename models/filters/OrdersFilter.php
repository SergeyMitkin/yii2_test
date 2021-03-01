<?php

namespace app\models\filters;

use app\models\tables\Rates;
use app\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\tables\Orders;

/**
 * AccountServersFilter represents the model behind the search form of `app\models\tables\Servers`.
 */
class OrdersFilter extends Orders
{
    public $rate_name;
    public $user_email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rate_id'], 'integer'],
            [['date', 'rate_name', 'user_email', 'status'], 'safe'],
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
        $query->joinWith(['user']);

        // add conditions that should always apply here

        // Порядок вывода заказов
            // Новые заказы
        if (\Yii::$app->controller->module->id === 'admin'){
            if (\Yii::$app->controller->action->id === 'index'){
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort'=> ['defaultOrder' => ['date' => SORT_ASC]]
                ]);

            }
            // Принятые заказы
            else if (\Yii::$app->controller->action->id === 'confirmed'){
                // Выводим заказы только принятые
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'sort'=> ['defaultOrder' => ['date' => SORT_DESC]]
                ]);
            }
        }

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
            'orders.id' => $this->id,
        ])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', Rates::tableName().'.name', $this->rate_name])
            ->andFilterWhere(['like', User::tableName().'.email', $this->user_email]);

            if (\Yii::$app->controller->module->id === 'admin'){
                if (\Yii::$app->controller->action->id === 'index'){
                    $query ->andFilterWhere(['status' => 0]); // Выводим заказы только новые заказы
                }
                else if (\Yii::$app->controller->action->id === 'confirmed'){
                    $query ->andFilterWhere(['status' => 1]); // Выводим заказы только принятые
                }
            }
        return $dataProvider;
    }
}
