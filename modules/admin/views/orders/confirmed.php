<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.10.2020
 * Time: 19:18
 */

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker; // Подключаем виджет для фильтра по дате

$this->title = 'Подтверждённые Заказы';

?>
<div class="admin-confirmed">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    Pjax::begin(['enablePushState' => false]);
    echo GridView::widget([
        'dataProvider' => $ordersDataProvider,
        'filterModel' => $ordersSearchModel,
        'headerRowOptions' => [
            'class' => 'header-row'
        ],
        'summary' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'attribute' => 'id',
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->id);
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
                'attribute' => 'rate_name',
                'label' => 'Тариф',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\tables\Rates::find()->all(), 'id', 'ru_name'),
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->rate->ru_name);
                },
            ],
            [
                'attribute' => 'date',
                'label' => 'Дата и время',
                'format' => 'raw',
                'value' => function($model){
                    return Html::tag('span', $model->date);
                },
                'filter' => DatePicker::widget([
                    'model' => $ordersSearchModel,
                    'attribute' => 'date',
                    'language' => 'ru',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ],
        ]
    ]);
    Pjax::end();
    ?>
</div>
