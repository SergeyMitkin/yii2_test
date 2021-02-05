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

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = array(
    'label'=> $this->title,
    'url'=>Url::toRoute('account/index')
);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Тарифы',
    'url'=>Url::toRoute('account/rates')
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
                            'attribute' => 'Rate',
                            'label' => 'Тариф'
                        ],
                        [
                            'attribute' => 'date',
                            'label' => 'Дата'
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
                            'attribute' => 'Rate',
                            'label' => 'Тариф'
                        ],
                        [
                            'attribute' => 'date',
                            'label' => 'Дата'
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Статус',
                            // Вывадим статус заказа
                            'value' => function($model_orders){
                                $status_name = ($model_orders['status'] == 0) ? 'Новый' : 'Подтверждён';
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