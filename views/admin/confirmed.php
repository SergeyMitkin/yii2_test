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
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

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
<div class="admin-confirmed">

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" data-toggle="tab" href="#home" role="tab">Серверы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Заказы</a>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="home" role="tabpanel">

            <div class="div-admin-servers">
                <h1>Предоставленные Серверы</h1>
                <?php
                $serverDataProvider = new ActiveDataProvider([
                    'query' => $serverQuery,
                    'sort' => false
                ]);
                Pjax::begin();
                echo GridView::widget([
                    'dataProvider' => $serverDataProvider,
                    'summary' => false,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        'id',
                        [
                            'attribute' => 'order_id',
                            'label' => 'Id заказа'
                        ],
                        [
                            'attribute' => 'email',
                            'label' => 'Email пользователя'
                        ],
                        [
                            'attribute' => 'Rate',
                            'label' => 'Тариф'
                        ],
                        [
                            'attribute' => 'date',
                            'label' => 'Дата и время'
                        ],
                    ]
                ]);
                Pjax::end();
                ?>
            </div>
        </div>

        <div class="tab-pane" id="profile" role="tabpanel">

            <div class="div-admin-orders">
                <h1><?= Html::encode($this->title) ?></h1>

                <?php
                $dataProvider = new ActiveDataProvider([
                    'query' => $orderQuery,
                    'sort' => false
                ]);
                Pjax::begin();
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        'id',
                        [
                            'attribute' => 'email',
                            'label' => 'Email пользователя'
                        ],
                        [
                            'attribute' => 'Rate',
                            'label' => 'Тариф'
                        ],
                        [
                            'attribute' => 'date',
                            'label' => 'Дата'
                        ],
                    ]
                ]);
                Pjax::end();
                ?>
            </div>
        </div>
    </div>
</div>

