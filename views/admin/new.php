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
use yii\bootstrap\Modal;
use dosamigos\datepicker\DatePicker; // Подключаем виджет для фильтра по дате

// Регистрируем CSS file
$this->registerCssFile('css/admin-new.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

$this->title = 'Новые Заказы';
$this->params['breadcrumbs'][] = array(
    'label'=> $this->title,
    'url'=>Url::toRoute('admin/new')
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Подтверждённые Закзы',
    'url'=>Url::toRoute('admin/confirmed')
);

?>
<div class="admin-new">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    Pjax::begin(['id' => 'admin-new-orders']);
    echo GridView::widget([
        'dataProvider' => $ordersDataProvider,
        'filterModel' => $ordersSearchModel,
        'summary' => false,
        'headerRowOptions' => [
            'class' => 'header-row'
        ],
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
                'format' => 'html',
                'filter' => [ "1"=>"Тариф 1", "14"=>"Тариф 14", "3"=>"Тариф 3" ],
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
                    'model' => $ordersSearchModel,
                    'attribute' => 'date',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                // Кнопка принятия заказа
                'template' => '{confirm} {cancel}',
                'buttons' => [
                    'confirm' => function ($url, $model_orders, $key) {

                        $options = [
                            'title' => 'Подтвердить',
                            'aria-label' => 'Подтвердить',
                            'class' => 'accept-icons span-in-td',
                            'data-order-id' => $key,
                            'data-url' => $url,
                            'data-action' => 'confirm',
                            'data-toggle' => 'modal',
                            'data-target' => '#action-order-modal'
                        ];

                        return Html::a('<span class="glyphicon glyphicon-ok-sign"></span>', $url, $options);
                    },

                    // Кнопка удаления заказа
                    'cancel' => function ($url, $model_orders, $key){

                        $options = [
                            'title' => 'Отменить',
                            'aria-label' => 'Отменить',
                            'class' => 'accept-icons span-in-td',
                            'data-order-id' => $key,
                            'data-url' => $url,
                            'data-action' => 'cancel',
                            'data-toggle' => 'modal',
                            'data-target' => '#action-order-modal'
                        ];

                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, $options);
                    }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'confirm') {
                        $url = Url::current(['id' => $key, 'action' => 'confirm']);
                        return $url;
                    }
                    if ($action === 'cancel'){
                        $url = Url::current(['id' => $key, 'action' => 'cancel']);
                        return $url;
                    }
                }
            ]
        ]
    ]);
    Pjax::end();
    ?>
</div>

<?php
// Модальное окно принятия заказа
Modal::begin([
    'headerOptions' => [
        'style' => 'display:none;'
    ],
    'footerOptions' => [
        'style' => 'display:none;'
    ],
    'options' => [
        'id' => 'action-order-modal'
    ],
    'size' => Modal::SIZE_SMALL,
]);

echo 'Модальное окно';

Modal::end();

// Регистрируем JS file
$this->registerJSFile(Yii::$app->request->baseUrl.'/js/admin-new.js',['depends' => [\yii\web\JqueryAsset::className()]]);
