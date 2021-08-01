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
use dosamigos\datepicker\DatePicker;

$this->title = 'Новые Заказы';
$this->params['breadcrumbs'][] = $this->title;
echo substr(Yii::$app->request->cookies['language'], 0, 2);
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
                    return Html::tag('span', $model->id);
                }
            ],
            [
                'attribute' => 'user_email',
                'label' => 'Email пользователя',
                'format' => 'html',
                'value' => function($model){
                    return Html::tag('span', $model->user->email);
                }
            ],
            [
                'attribute' => 'rate_name',
                'label' => 'Тариф',
                'format' => 'html',
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\tables\Rates::find()->all(), 'id', 'ru_name'),
                'value' => function($model){
                    return Html::tag('span', $model->rate->ru_name);
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'Дата и время',
                'format' => 'raw',
                'value' => function($model){
                    return Html::tag('span', $model->date);
                },
                'filter' => DatePicker::widget([
                    'model' => $ordersSearchModel,
                    'attribute' => 'date',
                    'language' => 'ru',
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
                            'class' => 'accept-icons',
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
                            'class' => 'accept-icons',
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
