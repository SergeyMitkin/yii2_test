<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 05.10.2020
 * Time: 0:35
 */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = $title;
$this->params['breadcrumbs'][] = array(
    'label'=> 'Личный Кабинет',
    'url'=>Url::toRoute('account/index')
);
$this->params['breadcrumbs'][] = array(
    'label'=> $this->title,
    'url'=>Url::toRoute('account/rates')
);
?>
<div class="rate-rates">
    <h1><?= Html::encode($this->title) ?></h1>
<?php
    $dataProvider = new ActiveDataProvider([
        'query' => $model::find(),
        'sort' => false
    ]);

    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
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
                        $id = 'order-button_'.$key;

                        // Стилизация кнопки
                        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);

                        $url = Url::toRoute(['account/index', 'id' => $key]);

                        $options = [
                            'title' => 'Заказать',
                            'aria-label' => 'Заказать',
                            'id' => $id,
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
