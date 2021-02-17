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
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            'id',
            [
                'attribute' => 'user_email',
                'label' => 'Email пользователя',
                'value' => function($model){
                    return $model->user->email;
                }
            ],
            [
                'attribute' => 'rate_name',
                'label' => 'Тариф',
                'filter' => [ "1"=>"Тариф 1", "2"=>"Тариф 2", "3"=>"Тариф 3" ],
                'value' => function($model){
                    return $model->rate->name;
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'Дата и время',
                'value' => 'date',
                'format' => 'raw',
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
                'template' => '{confirm}',
                'buttons' => [
                    'confirm' => function ($url, $model_orders/*, $key*/) {

                        $order_id = $model_orders['id'];
                        $iconName = "ok-sign";
                        $id_tag = 'confirm-icon_'.$order_id;
                        $url = Url::current(['id' => $order_id]);

                        $options = [
                            'title' => 'Подтвердить',
                            'aria-label' => 'Подтвердить',
                            'id' => $id_tag,
                            'class' => 'accept-icons',
                            'data-order-id' => $order_id,
                            'data-url' => $url,
                            'data-toggle' => 'modal',
                            'data-target' => '#confirm-order-modal',
                        ];

                        // Стилизация кнопки
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);

                        return Html::a($icon, $url, $options);
                    },
                ],
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
        'id' => 'confirm-order-modal'
    ],
    'size' => Modal::SIZE_SMALL,
]);

echo 'Модальное окно';

Modal::end();

// Регистрируем JS file
$this->registerJSFile(Yii::$app->request->baseUrl.'/js/admin-new.js',['depends' => [\yii\web\JqueryAsset::className()]]);
