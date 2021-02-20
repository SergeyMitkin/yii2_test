<?php

namespace app\controllers;

use app\models\tables\GalleryImage;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

class GalleryImageController extends \yii\web\Controller
{

    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'gallery-image' => GalleryImage::className()
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = GalleryImage::find()->all();
        return $this->render('index', ['model' => $dataProvider[0]]);
    }

}