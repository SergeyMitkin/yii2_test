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
        // Записи таблицы gallery_image
        $imagesDataProvider = GalleryImage::find()
            ->all();

        // Записи таблицы gallery_image - галлереи
        $galleriesDataProvider = array();
        for ($i=0; $i<count($imagesDataProvider); $i++){
            if ($imagesDataProvider[$i]['rank'] == 0){
                array_push($galleriesDataProvider, $imagesDataProvider[$i]);
            }
        }

        return $this->render('index', [
            'model' => $imagesDataProvider,
            'galleries' => $galleriesDataProvider
        ]);
    }

}