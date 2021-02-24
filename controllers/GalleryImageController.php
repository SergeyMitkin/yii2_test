<?php

namespace app\controllers;

use app\models\tables\Galleries;
use app\models\tables\GalleryImage;

use zxbodya\yii2\galleryManager\GalleryManagerAction;


class GalleryImageController extends \yii\web\Controller
{



    public function actionIndex()
    {
        $model = new GalleryImage();
        //$galleries_model = new Galleries();
        $request = \Yii::$app->request;



        return $this->render('index');
    }

}