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

// Подключаем ассет
\app\assets\AccountIndexAsset::register($this);

$this->title = Yii::t("app", "account title");
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="title-div">
    <h2 class="title-h"><?= Html::encode($this->title) ?> (<?=$username?>)</h2>
</div>

<div class="account-index">

    <div class="tabs">

        <div class="tabs-ul">
            <ul id="ul-account-index" class="nav nav-tabs" role="tablist">
                <li id="servers_li" class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#servers_content" role="tab"><?= Yii::t("app", "servers") ?></a>
                </li>

                <li id="orders_li" class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#orders_content" role="tab"><?= Yii::t("app", "orders") ?></a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane" id="servers_content" role="tabpanel">
                <div class="div-user-servers">

                    <div class="tab-title-div">
                        <h3 class="tab-title-h"><?= Yii::t("app", "provided servers") ?></h3>
                    </div>

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
                                'label' => Yii::t("app", "rate"),
                                'filter' => \yii\helpers\ArrayHelper::map($model_rates::find()->all(),'id', 'name'),
                                'format' => 'html',
                                'value' => function($model){
                                    return Html::tag('span', $model->rate->name, ['class' => 'span-in-td']);
                                }
                            ],
                            [
                                'attribute' => 'date',
                                'label' => Yii::t("app", "date and time"),
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
                    <div class="tab-title-div"><h3 class="tab-title-h"><?= Yii::t("app", "my orders") ?></h3></div>
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
                                'label' => Yii::t("app", "rate"),
                                'filter' => \yii\helpers\ArrayHelper::map($model_rates::find()->all(),'id', 'name'),
                                'format' => 'html',
                                'value' => function($model){
                                    return Html::tag('span', $model->rate->name, ['class' => 'span-in-td']);
                                }
                            ],
                            [
                                'attribute' => 'date',
                                'label' => Yii::t("app", "date and time"),
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
                                'label' => Yii::t("app", "status"),
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
</div>