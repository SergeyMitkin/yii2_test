<?php
/* @var $this yii\web\View */

use zxbodya\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model \app\models\tables\GalleryImage */
?>

    <div id="div-gallery-create-button">
        <button type="button" class="btn btn-success" id="gallery-create-button">Создать галерею</button>
    </div>

<?
for ($i=0; $i<count($galleries); $i++){
    $owner_id = $galleries[$i]['id'];

    ?>
    <div class="row">
        <div class="col-xs-12 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3><?=$galleries[$i]['name']?></h3>
                    <p><?=$galleries[$i]['description']?></p>
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
    </div>
<?}
?>

<?php
/*
foreach ($model[0]->getBehavior('galleryBehavior')->getImages() as $image) {
    echo \yii\helpers\Html::img($image->getUrl('small'));
}
*/