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
$this->registerCssFile('css/admin-confirmed.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

$this->title = 'Подтверждённые Заказы';
$this->params['breadcrumbs'][] = array(
    'label'=> 'Новые Заказы',
    'url'=>Url::toRoute('admin/new')
);

$this->params['breadcrumbs'][] = array(
    'label'=> $this->title,
    'url'=>Url::toRoute('admin/confirmed')
);

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
                    return Html::tag('span', $model->id, ['class' => 'span-in-td']);
                }
            ],
            [
                'attribute' => 'order_id',
                'label' => 'Id заказа',
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->order->id, ['class' => 'span-in-td']);
                }
            ],
            [
                'attribute' => 'user_email',
                'label' => 'Email пользователя',
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->user->email, ['class' => 'span-in-td']);
                }
            ],
            [
                'attribute' => 'rate_name',
                'label' => 'Тариф',
                'filter' => [ "1"=>"Тариф 1", "2"=>"Тариф 2", "3"=>"Тариф 3" ],
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->rate->name, ['class' => 'span-in-td']);
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'Дата и время',
                'format' => 'raw',
                'value' => function($model){
                    return Html::tag('span', $model->date, ['class' => 'span-in-td']);
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