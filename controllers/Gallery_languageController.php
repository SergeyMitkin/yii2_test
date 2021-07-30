<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2021
 * Time: 23:15
 */

namespace app\controllers;


use onmotion\gallery\controllers\DefaultController;
use onmotion\gallery\models\GalleryPhoto;
use onmotion\helpers\File;
use onmotion\helpers\Translator;
use Yii;
use yii\web\Response;

// Переопределяем методы контроллера из вендора для перевода на русский язык
class Gallery_languageController extends DefaultController
{
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $galleryId = $model->gallery_id;
        $dir = Yii::getAlias('@app/web/img/gallery/' . Translator::rus2translit($model->name));
        try{
            File::removeDirectory($dir);
        } catch (\Exception $e){
            echo(Yii::t('app', 'something went wrong') . $dir . ' - ' . $e->getMessage());
        }
        if($model->delete()){
            GalleryPhoto::deleteAll(['gallery_id' => $galleryId]);
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => false,
                'forceReload' => true,
                'title' => Yii::t('app', 'deleting gallery'),
                'content' => Yii::t('app', 'success'),
                'hideActionButton' => true
            ];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }
}