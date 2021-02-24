<?php
/* @var $this yii\web\View */

use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\GalleryImage */
// Регистрируем CSS file
$this->registerCssFile('css/galleries-index.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

?>

<?
// Модальное окно формы создания галереи
Modal::begin([
    'headerOptions' => [
        'style' => 'display:none;'
    ],
    'footerOptions' => [
        'style' => 'display:none;'
    ],
    'toggleButton' => [
        'label' => 'Создать галерею',
        'tag' => 'button',
        'id' => 'gallery-create-button',
        'class' => 'btn btn-success'
    ],
    'options' => [
        'id' => 'create-gallery-modal'
    ],
]);

ActiveForm::begin([
    'method' => 'post',
    'options' => [
        'class' => 'create-gallery-form',
        'id' => 'create-gallery-form-id'
    ]
]);
echo '<div class="input-group input-group-sm form-group" id="group-for-gallery-name-input">' .
    Html::label('Название галереи', 'gallery-modal-name-input').
    Html::input(
        'text',
        'gallery_name',
        '',
        [
            'id' => 'gallery-modal-name-input',
            'class' => 'form-control',
            'placeholder' => 'Название галереи'
        ]
    ) .
    '</div>' .

    '<div class="form-group">' .
    Html::label('Описание галереи', 'gallery-modal-description-textarea') .
    Html::textarea(
        'gallery_description',
        '',
        [
            'class' => 'form-control',
            'id' => 'gallery-modal-description-textarea',
            'placeholder' => 'Описание галереи',
            'rows' => 3
        ]
    ) .
    '</div>' .

    '<span class="input-group-btn">' .
    Html::submitButton('Отправить', ['class' => 'btn btn-success']) .
    '</span>';
ActiveForm::end();
Modal::end();
?>

    <div class="row">
        <?
        Pjax::begin(['id' => 'galleries-listView', 'clientOptions' => ['method' => 'POST']]);
        echo
        \yii\widgets\ListView::widget([
            'dataProvider' => $galleries,
            'itemView' => 'view',
            'viewParams' => ['images_query' => $images_query]
        ]);
        Pjax::end();
        ?>
    </div>

<?php
// Модальное окно подтверждения удаления галереи
Modal::begin([
    'headerOptions' => [
        'style' => 'display:none;'
    ],
    'footerOptions' => [
        'style' => 'display:none;'
    ],
    'options' => [
        'id' => 'delete-gallery-modal'
    ],
    'size' => Modal::SIZE_SMALL,
]);

echo 'Модальное окно';

Modal::end();
/*
foreach ($model[0]->getBehavior('galleryBehavior')->getImages() as $image) {
    echo \yii\helpers\Html::img($image->getUrl('small'));
}
*/

// Регистрируем JS file
$this->registerJSFile('@web/js/galleries-index.js',['depends' => [\yii\web\JqueryAsset::className()]]);
