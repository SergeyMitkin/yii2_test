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
use dosamigos\datepicker\DatePicker; // Подключаем виджет для фильтра по дате

// Регистрируем CSS file
$this->registerCssFile('css/account-index.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = array(
    'label'=> $this->title,
    'url'=>Url::toRoute('account/index')
);
?>
<div class="account-index">
    <h1><?= Html::encode($this->title) ?> (<?=$username?>)</h1>

    <ul id="ul-account-index" class="nav nav-tabs" role="tablist">
        <li id="servers_li" class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#servers_content" role="tab">Серверы</a>
        </li>
        <li id="orders_li" class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#orders_content" role="tab">Заказы</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="servers_content" role="tabpanel">
            <div class="div-user-servers">
                <h3>Предоставленные серверы</h3>
                <?php
                Pjax::begin();
                echo GridView::widget([
                    'dataProvider' => $serversDataProvider,
                    'filterModel' => $serversSearchModel,
                    'summary' => false,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        'id',
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
                            'value' => 'date',
                            'format' => 'raw',
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

                <h3>Мои заказы</h3>
                <?php
                Pjax::begin();
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
                            'attribute' => 'rate_name',
                            'label' => 'Тариф',
                            'filter' => [ "1"=>"Тариф 1", "2"=>"Тариф 2", "3"=>"Тариф 3" ],
                            'value' => function($model){
                                return $model->rate->name;
                            }
                        ],
                        [
                            'attribute' => 'date',
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
                        /*
                        [
                            'attribute' => 'date',
                            'label' => 'Дата'
                        ],
                        */
                        [
                            'attribute' => 'status',
                            'label' => 'Статус',
                            'filter' => [ "0"=>"Новый", "1"=>"Подтверждён"],
                            // Вывадим статус заказа
                            'value' => function($model){
                                $status_name = ($model['status'] == 0) ? 'Новый' : 'Подтверждён';
                                return $status_name;
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

<?
// Определяем аткивную вкладку личного кабинета
$active = 'servers';
$request = Yii::$app->request;
$active = ($request->get()[1]['active_li'] !== NULL) ? $request->get()[1]['active_li'] : 'servers';
?>
<script>
    var active = "<?php echo $active?>";
</script>
<?
// Регистрируем JS file
$this->registerJSFile(Yii::$app->request->baseUrl.'/js/account-index.js',['depends' => [\yii\web\JqueryAsset::className()]]);