<?php
use yii\data\ActiveDataProvider;

\app\assets\IndexAsset::register($this);
?>

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