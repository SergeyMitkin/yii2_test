<?php

use yii\helpers\Url;
use zxbodya\yii2\galleryManager\GalleryManager;

?>
<div class="col-xs-4 text-center">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="gallery-titles">
                <h3><?=$model->name?></h3>
                <p><?=$model->description?></p>
            </div>
            <div class="gallery-actions">
                    <span id="gallery-edit-span-id_<?=$key?>" class="edit-gallery-span btn btn-primary btn-xs" data-toggle="modal", data-target="#create-gallery-modal">
                        <i class="glyphicon glyphicon-pencil gliphicon-white"></i>
                    </span>
                <span class="delete-gallery-span btn btn-danger btn-xs" data-gallery-id="<?=$key?>" data-url="<?=Url::current(['gallery_id' => $key])?>" data-toggle="modal", data-target="#delete-gallery-modal">
                        <i class="glyphicon glyphicon-remove gliphicon-white"></i>
                    </span>
            </div>
        </div>
        <div class="panel-body">
            <?php
            if ($images_query->all()[$index]->isNewRecord) {
                echo 'Can not upload images for new record';
            } else {
                echo GalleryManager::widget(
                    [
                        'model' => $images_query->all()[$index],
                        'behaviorName' => 'galleryBehavior',
                        'apiRoute' => 'gallery-image/galleryApi'
                    ]
                );
            }
            ?>
        </div>
    </div>
</div>

