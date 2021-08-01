<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\ServersFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Серверы';

?>
<div class="servers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'order_id',
                'label' => 'ID заказа',
            ],
            [
                'attribute' => 'rate_name',
                'label' => 'Тариф',
                'format' => 'html',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\tables\Rates::find()->all(), 'id', 'ru_name'),
                'value' => function($model){
                    return Html::tag('span', $model->rate->ru_name);
                }
            ],
            [
                'attribute' => 'user_email',
                'label' => 'Email пользователя',
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->user->email);
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'Дата и время',
                'format' => 'raw',
                'value' => function($model){
                    return Html::tag('span', $model->date);
                },
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
