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

\app\assets\AccountIndexAsset::register($this);

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = array(
    'label'=> $this->title,
    'url'=>Url::toRoute('account/index')
);
?>
<div class="account-index">
    <h1><?= Html::encode($this->title) ?> (<?=$username?>)</h1>

    <ul id="ul-account-index" class="nav nav-tabs" role="tablist">
        <li id="servers_li" class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#servers_content" role="tab">Серверы</a>
        </li>
        <li id="orders_li" class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#orders_content" role="tab">Заказы</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="servers_content" role="tabpanel">
            <div class="div-user-servers">
                <h3>Предоставленные серверы</h3>
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
                            'format' => 'html',
                            'value' => function($model){
                                return Html::tag('span', $model->id, ['class' => 'span-in-td']);
                            }
                        ],
                        [
                            'attribute' => 'rate_name',
                            'label' => 'Тариф',
                            'filter' => \yii\helpers\ArrayHelper::map($model_rates::find()->all(),'id', 'name'),
                            'format' => 'html',
                            'value' => function($model){
                                return Html::tag('span', $model->rate->name, ['class' => 'span-in-td']);
                            }
                        ],
                        [
                            'attribute' => 'date',
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
                        ]
                    ]
                ]);
                Pjax::end();
                ?>
            </div>
        </div>

        <div class="tab-pane" id="orders_content" role="tabpanel">
            <div class="div-user-orders">

                <h3>Мои заказы</h3>
                <?php
                Pjax::begin();
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
                                return Html::tag('span', $model->id, ['class' => 'span-in-td']);
                            }
                        ],
                        [
                            'attribute' => 'rate_name',
                            'label' => 'Тариф',
                            'filter' => \yii\helpers\ArrayHelper::map($model_rates::find()->all(),'id', 'name'),
                            'format' => 'html',
                            'value' => function($model){
                                return Html::tag('span', $model->rate->name, ['class' => 'span-in-td']);
                            }
                        ],
                        [
                            'attribute' => 'date',
                            'format' => 'raw',
                            'value' => function($model){
                                return Html::tag('span', $model->date, ['class' => 'span-in-td']);
                            },
                            'filter' => DatePicker::widget([
                                'model' => $ordersSearchModel,
                                'attribute' => 'date',
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd'
                                    ]
                            ])
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Статус',
                            'filter' => [ "0"=>"Новый", "1"=>"Подтверждён"],
                            // Вывадим статус заказа
                            'format' => 'html',
                            'value' => function($model){
                                $status_name = ($model['status'] == 0) ? 'Новый' : 'Подтверждён';
                                return Html::tag('span', $status_name, ['class' => 'span-in-td']);
                            }
                        ]
                    ]
                ]);
                Pjax::end();
                ?>
            </div>
        </div>
    </div>
</div>