<?php

use kartik\file\FileInput;
use onmotion\gallery\Gallery;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use onmotion\helpers\Translator;

\app\assets\GalleryViewAsset::register($this);
\app\assets\FileInputAssetLanguage::register($this);

$this->title = Yii::t("app", "gallery title");
$photos_count = count((array)$photos);

/* @var $this yii\web\View */
/* @var $model onmotion\gallery\models\Gallery */
/* @var $photos onmotion\gallery\models\GalleryPhoto */

set_time_limit(60);
ini_set('memory_limit', '512M');


$this->registerJs(<<<JS
$('#preloader').show();
$('body').css('overflow', 'hidden');
window.onload = function() {
	$('body').css('overflow', 'auto');
    $('#preloader').hide();
  };
   $("[data-toggle='tooltip']").tooltip();
JS
);
?>

    <div class="title-div">
        <h2 class="title-h"><?= Html::encode($this->title) ?></h2>
    </div>

<?

$this->params['breadcrumbs'][] = ['label' => Yii::t("app", "gallery title"), 'url' => ['/gallery']];
$this->params['breadcrumbs'][] = $model->name;

            echo Html::beginTag('div', ['class' => 'gallery-view']);
            echo \yii\bootstrap\Collapse::widget([
                'items' => [
                    [
                        'label' => $model->name . ' (' . $photos_count . ' ' . Yii::t('app', 'photos count', ['n' => $photos_count]) . ')',
                        'content' => !empty($model->descr) ? $model->descr : ''
                    ]
                ],
                'options' => [
                    'class' => 'header-collapse'
                ]
            ]);
            $galleryName = $model->name;

            if (!empty($photos)) {
                foreach ($photos as $photo) {
                    $items[] =
                        [
                            'original' => '/img/gallery/' . Translator::rus2translit($galleryName) . '/' . $photo->name,
                            'thumbnail' => '/img/gallery/' . Translator::rus2translit($galleryName) . '/thumb/' . $photo->name,
                            'options' => [
                                'title' => $galleryName,
                                'data-id' => $photo->photo_id,
                            ],
                        ];
                };
            } else {
                echo '<span class="no-photos">' . Yii::t("app", "no photos") . '</span>';
            }
            ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <?php
                    if (!empty($items))
                        echo \app\widgets\GalleryLanguage::widget([
                            'id' => 'gallery-links',
                            'items' => $items,
                            'pluginOptions' => [
                                'slideshowInterval' => 2000,
                                'transitionSpeed' => 200,
                                ],
                        ]);
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>
            <?php
            echo Collapse::widget([
                'items' => [
                    [
                        'label' => Yii::t('app', 'upload photo'),
                        'content' =>
                            '<input id="input-1a" name="image[]" type="file" class="file-loading" data-language="' . Yii::t('app', 'language') .'" multiple>' .
                            ' <div id="errorBlock"><ul class="alert-warning-message"></ul></div>'
                    ]
                ],
                'options' => [
                    'class' => 'download-collapse'
                ]
            ]);
                echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['#'],
                    ['title' => Yii::t('app', 'edit mode'), 'class' => 'btn btn-default', 'id' => 'check-toggle',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover"]);
                echo Html::a('<i class="glyphicon glyphicon-check"></i>', ['#'],
                    ['title' => Yii::t('app', 'check all'), 'class' => 'btn btn-default', 'style' => "display:none", 'id' => 'check-all',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover"]);

                echo Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'],
                    ['title' => Yii::t('app', 'reset'), 'class' => 'btn btn-default', 'style' => "display:none", 'id' => 'reset-all',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover"]);
                echo Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::toRoute('gallery_language/photos-delete'),
                    ['title' => Yii::t('app', 'delete photos'), 'class' => 'btn btn-danger', 'style' => "display:none", 'id' => 'photos-delete-btn',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover", 'data-method' => 'post',
                        'role' => 'modal-toggle',
                        'data-modal-title'=>Yii::t('app', 'delete photos'),
                        'data-modal-body'=>Yii::t('app', 'are you sure?'),
                    ]);
echo Html::endTag('div');

Modal::begin([
    "id" => "gallery-modal",
    'header' => '<h4 class="modal-title"></h4>',
    "footer" =>
        Html::a(Yii::t('app', 'close'), ['#'],
            ['title' => Yii::t('app', 'cancel'), 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
        Html::a('ОК', Url::toRoute('photos-delete'),
            ['title' => '', 'class' => 'btn btn-primary', 'id' => 'photos-delete-confirm-btn']),
]);

Modal::end();

echo Html::beginTag('div', ['class' => 'preloader']);
echo Html::tag('div', Html::tag('span', '100', ['class' => 'sr-only']), ['class'=>"progress-bar progress-bar-striped active", 'role'=>"progressbar",
    'aria-valuenow'=>"100", 'aria-valuemin'=>"0", 'aria-valuemax'=>"100", 'style'=>"width:100%"]);
echo Html::endTag('div');


$this->registerJs(<<<JS

$(document).ready(function() {
    var inputField = $("#input-1a");
    if (!inputField) {
        console.log('input field not found.');
        return;
    } 
    inputField.fileinput({
        showPreview: false,
        uploadUrl: 'fileupload',
        uploadAsync: true,
        uploadExtraData: {
           'gallery_id': "$model->gallery_id",
           'gallery_name': "$model->name",
        },
        maxFileCount: 1000,
        allowedFileTypes: ['image'],
        allowedFileExtensions: ['jpg', 'png'],
        messageOptions: {
           'class': 'alert-warning-message'
        },
        elErrorContainer: '#errorBlock'
    });
    
    inputField.on('fileunlock', function(event, data, previewId, index) {
        inputField.on('fileunlock', function(event, data, previewId, index){
            location.reload();
        }) 
    }); 
});
JS
);
?>