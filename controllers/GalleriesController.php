<?php

namespace app\controllers;

use app\models\tables\Galleries;
use app\models\tables\GalleryImage;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

class GalleriesController extends \yii\web\Controller
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
        $galleries_model = new Galleries();
        $images_model = new GalleryImage();
        $request = \Yii::$app->request;

        if ($request->isAjax && $request->isGet){
            if ($request->get('ajax') == 'get-gallery-data'){
                $gallery_data = Galleries::findOne($request->get('gallery_id'));
                echo Json::encode($gallery_data);
                exit;
            }
        }

        if ($request->isPjax && $request->get('action') == 'delete-gallery'){
            $galleries_model->deleteGallery($request->get('id'));
        }

        // Создаём галерею
        if ($request->isPost && null !== $request->post('gallery_name')){
            $galleries_model->setGallery($request->post('gallery_name'), $request->post('gallery_description'), $request->post('gallery_id'));
            return $this->redirect(['index']);
        }

        // Изображения
        $images_query = $images_model::find();

        // Галереи
        $galleries_query = $galleries_model::find();
        $galleriesDataProvider = new ActiveDataProvider([
            'query' => $galleries_query,
            'pagination' => [
                'pageSize' => 9
            ]
        ]);

        return $this->render('index', [
            'images_query' => $images_query,
            'galleries' => $galleriesDataProvider
        ]);
    }

}
