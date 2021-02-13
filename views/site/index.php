<?php
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

// Регистрируем CSS file
$this->registerCssFile('css/site-index.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

/* @var $this yii\web\View */
$this->title = 'Аренда выделеных серверов';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>АРЕНДА ВЫДЕЛЕННЫХ СЕРВЕРОВ</h1>
    </div>

    <div class="body-content">
        <h1>Выберите тариф</h1>

        <div class="rate-rates">
            <?php
            $dataProvider = new ActiveDataProvider([
                'query' => $model::find(),
                'sort' => false
            ]);

            Pjax::begin();
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'showHeader'=> false,
                    'tableOptions' => [
                        'class' => 'table table-inverse'
                    ],
                    'rowOptions' => [
                        'class' => 'rates-row',
                    ],
                    'columns' => [
                        [
                            'attribute' => 'name',
                            'format' => 'html',
                            'value' => function($model){
                                return Html::tag('span', $model->name, ['class' => 'rate-name-td']);
                            }
                        ],
                        [
                            'attribute' => 'price',
                            'value'=> function($model){
                                return $model->price . ' $';
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{order}',
                            'buttons' => [
                                'order' => function ($url, $model, $key) {

                                    $iconName = "shopping-cart";
                                    $id = 'order-icon_'.$key;

                                    // Стилизация кнопки
                                    $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);

                                    // При нажатии переходим на страницу выделенных серверов пользователя
                                    $url = Url::toRoute(['account/index', 'id' => $key]);

                                    $options = [
                                        'title' => 'Заказать',
                                        'aria-label' => 'Заказать',
                                        'class' => 'rate-order-buttons',
                                        'id' => $id,
                                        'data-rate-id' => $key,
                                        'data-price' => $model->price,
                                        'data-url' => $url,
                                        'data-toggle' => 'modal',
                                        'data-target' => '#rate-order-modal',
                                    ];

                                    return Html::a($icon, $url, $options);
                                },
                            ],
                        ],
                    ]
                ]);
            Pjax::end();
            ?>
        </div>
    </div>
</div>

<?php
// Модальное окно заказа тарифа
Modal::begin([
    'headerOptions' => [
        'style' => 'display:none;'
    ],

    'footerOptions' => [
        'style' => 'display:none;'
    ],

    'options' => [
        'id' => 'rate-order-modal'
    ],
    'size' => Modal::SIZE_DEFAULT,
]);

echo 'Модальное окно';

Modal::end();
?>

<script>
    var is_guest = "<? //php echo 'guest';
        if(Yii::$app->user->isGuest){
            echo 'guest';
        }else{
            echo 'authorized';
        }
    ?>"
</script>

<?
// Регистрируем JS file
$this->registerJSFile(Yii::$app->request->baseUrl.'/js/index.js',['depends' => [\yii\web\JqueryAsset::className()]]);
