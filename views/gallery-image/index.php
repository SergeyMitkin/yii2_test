<?php
/* @var $this yii\web\View */

use zxbodya\yii2\galleryManager\GalleryManager;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\GalleryImage */
// Регистрируем CSS file
$this->registerCssFile('css/gallery-index.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

?>

<?php
// Модальное окно формы создания галереи
Modal::begin([
    'headerOptions' => [
        'style' => 'display:none;'
    ],
    'toggleButton' => [
        'label' => 'Создать галерею',
        'tag' => 'button',
        'id' => 'gallery-create-button',
        'class' => 'btn btn-success'
    ],
    'footerOptions' => [
        'style' => 'display:none;'
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
for ($i=0; $i<count($galleries); $i++){
    $owner_id = $galleries[$i]['id'];
    ?>
    <div class="col-xs-12 text-center">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="gallery-titles">
                    <h3><?=$galleries[$i]['name']?></h3>
                    <p><?=$galleries[$i]['description']?></p>
                </div>
                <div class="gallery-actions">
                    <span class="editGallery btn btn-primary btn-xs">
                        <i class="glyphicon glyphicon-pencil gliphicon-white"></i>
                    </span>
                    <span class="deleteGallery btn btn-danger btn-xs">
                        <i class="glyphicon glyphicon-remove gliphicon-white"></i>
                    </span>
                </div>
            </div>
            <div class="panel-body">
                <?php
                if ($model[$i]->isNewRecord) {
                    echo 'Can not upload images for new record';
                } else {
                    echo GalleryManager::widget(
                        [
                            'model' => $model[$i],
                            'behaviorName' => 'galleryBehavior',
                            'apiRoute' => 'gallery-image/galleryApi'
                        ]
                    );
                }
                ?>
            </div>
        </div>
    </div>
    <?}
?>
</div>
<?php
/*
foreach ($model[0]->getBehavior('galleryBehavior')->getImages() as $image) {
    echo \yii\helpers\Html::img($image->getUrl('small'));
}
*/

// Регистрируем JS file
// $this->registerJSFile('@web/js/gallery-image-index.js',['depends' => [\yii\web\JqueryAsset::className()]]);
