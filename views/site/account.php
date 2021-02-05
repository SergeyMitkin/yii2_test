<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.10.2020
 * Time: 19:18
 */

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = array(
    'label'=> $this->title,
    'url'=>Url::toRoute('site/account')
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Rates',
    'url'=>Url::toRoute('rate/rates')
);

?>
<div class="site-account">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $dataProvider = new ActiveDataProvider([
    'query' => $model::find(),
    'sort' => false
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name'
        ]
    ]);

    ?>
</div>