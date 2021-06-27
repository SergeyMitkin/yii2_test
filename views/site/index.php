<?php

use yii\helpers\Html;
use yii\data\ActiveDataProvider;

\app\assets\IndexAsset::register($this);

$this->title = 'Доступные тарифы';
?>


<?
$this->params['breadcrumbs'][] = '';
?>


<div class="title-div">
    <h2 class="title-h"><?= Html::encode($this->title) ?></h2>
</div>

<!-- Список серверов из БД -->
<div class="u-layout-grid u-list u-list-1">

    <?
    $dataProvider = new ActiveDataProvider([
        'query' => $model::find(),
        'sort' => false
    ]);

    echo
    \yii\widgets\ListView::widget([
        'summary' => false,
        'options' => ['class' => 'u-repeater u-repeater-1 list-view'],
        'itemOptions' => ['class' => 'u-container-style u-list-item u-palette-1-light-3 u-repeater-item u-list-item-1'],
        'dataProvider' => $dataProvider,
        'itemView' => 'rate_view'
    ])

    ?>
</div>