<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 17.03.2016
 * Time: 13:32
 */

use yii\helpers\Html;
use yii\helpers\Url;
use onmotion\helpers\Translator;

$date = new DateTime($model->date);

?>

<div class="gallery-item">
    <div class="image">
        <?php
            echo Html::beginTag('div', ['class' => 'change-btns']);
            echo Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::toRoute(['/gallery_language/delete', 'id'=>$model->gallery_id]),
                ['title' => Yii::t('app', 'delete'),
                    'class' => 'update-btn',
                    'role' => 'modal-toggle',
                    'data-modal-title'=>Yii::t('app', 'are you sure?'),
                    'data-modal-body'=>Yii::t('app', 'delete warning'),
                ]);
            echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', Url::toRoute(['/gallery_language/update', 'id'=>$model->gallery_id]), [
                'title' => Yii::t('app', 'update'),
                'method' => 'get',
                'class'=>"update-btn",
                'role'=>"modal-toggle",
                'data-modal-title'=>Yii::t('app', 'update'),
            ]);
            echo Html::endTag('div');
        ?>

        <a class="image-wrap" href="<?= Url::toRoute(['view', 'id'=>$model->gallery_id]) ?>">
            <?php
            foreach($model->galleryPhotos as $prevPhoto){
                echo \yii\helpers\Html::img('/img/gallery/' . Translator::rus2translit($model->name) . '/thumb/' . $prevPhoto->name);
            };
            ?>
        </a>
    </div>
    <div class="name">
        <span><?= $model->name ?></span>
        <span class="date-gallery"><?= ' (' . $date->format('d.m.Y') . ')'  ?></span>
    </div>
</div>
