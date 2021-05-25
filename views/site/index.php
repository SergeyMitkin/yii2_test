<?php
use yii\data\ActiveDataProvider;
use yii\bootstrap\Modal;

\app\assets\IndexAsset::register($this);
?>


<section class="u-border-2 u-border-grey-75 u-clearfix u-grey-90 u-valign-top-xl u-section-1" id="carousel_baa4">
    <img class="u-image u-image-1" src="<?=Yii::getAlias("@web/images/80706e8709156a71eff417a4b5353bb19db3491e5f2a1c1dbd49e0f4a254a5b858124bfb19e6ab4f08a4620d99780d576d8c687380d2a245cd9fa1_12801.jpg")?>" data-image-width="1280" data-image-height="853">

    <div class="u-align-right u-container-style u-group u-palette-2-base u-shape-rectangle u-group-1">
        <div class="u-container-layout u-valign-middle-sm u-container-layout-4">
            <h2 class="u-align-center u-custom-font u-text u-text-7">Аренда выде​ленных серверов </h2>
        </div>
    </div>

    <!-- Список серверов из БД -->
    <div class="u-layout-grid u-list u-list-1">

        <?
        $dataProvider = new ActiveDataProvider([
            'query' => $model::find(),
            'sort' => false
        ]);

        echo
        \yii\widgets\ListView::widget([
            'summary' => false,
            'options' => ['class' => 'u-repeater u-repeater-1 list-view'],
            'itemOptions' => ['class' => 'u-container-style u-list-item u-palette-1-light-3 u-repeater-item u-list-item-1'],
            'dataProvider' => $dataProvider,
            'itemView' => 'rate_view'
        ])

        ?>
    </div>
</section>

<?php
// Модальное окно заказа тарифа
/*
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
*/
?>