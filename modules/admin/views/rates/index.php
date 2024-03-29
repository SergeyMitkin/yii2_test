<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\Rates */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тарифы';

?>
<div class="rates-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать тариф', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'ru_name',
                'format' => 'html',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\tables\Rates::find()->all(), 'id', 'ru_name'),
                'value' => function($model){
                    return Html::tag('span', $model->ru_name);
                }
            ],
            'ru_description',
            [
                'attribute' => 'en_name',
                'format' => 'html',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\tables\Rates::find()->all(), 'id', 'en_name'),
                'value' => function($model){
                    return Html::tag('span', $model->en_name);
                }
            ],
            'en_description',
            'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
