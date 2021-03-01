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
use yii\helpers\Url;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker; // Подключаем виджет для фильтра по дате

// Регистрируем CSS file
$this->registerCssFile('css/admin-orders-confirmed.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

$this->title = 'Подтверждённые Заказы';
?>

<div class="div-admin-servers">
    <h1>Предоставленные Серверы</h1>
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $serversDataProvider,
        'filterModel' => $serversSearchModel,
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
                'label' => 'Id сервера',
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->id);
                }
            ],
            [
                'attribute' => 'order_id',
                'label' => 'Id заказа',
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->order->id);
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
                'filter' => [ "1"=>"Тариф 1", "2"=>"Тариф 2", "3"=>"Тариф 3" ],
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->rate->name);
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
                    'model' => $serversSearchModel,
                    'attribute' => 'date',
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