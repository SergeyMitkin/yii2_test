<?php
/* @var $this yii\web\View */

use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\GalleryImage */
?>
<div class="row">
    <div class="col-xs-12 text-center">
        <div class="panel panel-default">
            <div class="panel-heading">Галерея "Фото"</div>
            <div class="panel-body">
                <?php
                if ($model->isNewRecord) {
                    echo 'Can not upload images for new record';
                } else {
                    echo GalleryManager::widget(
                        [
                            'model' => $model,
                            'behaviorName' => 'galleryBehavior',
                            'apiRoute' => 'gallery-image/galleryApi'
                        ]
                    );
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
    echo \yii\helpers\Html::img($image->getUrl('small'));
}