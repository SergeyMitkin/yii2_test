<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2021
 * Time: 23:15
 */

namespace app\controllers;


use onmotion\gallery\controllers\DefaultController;
use onmotion\gallery\models\Gallery;
use onmotion\gallery\models\GalleryPhoto;
use onmotion\helpers\File;
use onmotion\helpers\Image;
use onmotion\helpers\Translator;
use Yii;
use yii\web\Response;
use yii\helpers\Html;


// Переопределяем методы контроллера из вендора для перевода на русский язык
class Gallery_languageController extends DefaultController
{

    public function actionFileupload()
    {
        $extraData = Yii::$app->request->post();
        $model = new GalleryPhoto();

        if (!empty($_FILES) && $_FILES['image']['error'][0] == 0) {
            $imageTmpName = $_FILES["image"]["tmp_name"][0];
            $pathinfo = pathinfo($_FILES["image"]["name"][0]);
            $imageName = $pathinfo['filename'] . uniqid() . '.' . $pathinfo['extension'];
            list($width, $height) = getimagesize($imageTmpName);

            $ratio = $width / $height;
            $newWidth = ($width < 1500) ? $width : 1500;
            $newHeight = round($newWidth / $ratio);
            try {
                $filepath = Yii::getAlias('@webroot/img/gallery/' . Translator::rus2translit(Html::encode($extraData['gallery_name'])) . '/' . $imageName);
                $thumbPath = Yii::getAlias('@webroot/img/gallery/' . Translator::rus2translit(Html::encode($extraData['gallery_name'])) . '/thumb/' . $imageName);

                $imageType = 'undefined';
                $image_p = imagecreatetruecolor($newWidth, $newHeight);
                $image_t = imagecreatetruecolor(110, 110);
                try {
                    $image = imagecreatefrompng($imageTmpName);
                    $imageType = 'png';
                } catch (\Exception $e){
                    try {
                        $image = imagecreatefromjpeg($imageTmpName);
                        $imageType = 'jpeg';
                    } catch (\Exception $e){
                        try {
                            $image = imagecreatefromgif($imageTmpName);
                            $imageType = 'gif';
                        } catch (\Exception $e){
                            throw new Exception($e->getMessage());
                        }
                    }
                }

                imagecopyresized($image_p, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                $w = 110;
                $h = 110;

                if ($width > $height) {
                    $r = $width / $height;
                    imagecopyresampled($image_t, $image, 0, 0, 0, 0, ($w*$r), $h, $width, $height);
                } else {
                    $r = $height/$width;
                    imagecopyresampled($image_t, $image, 0, 0, 0, 0, $w, ($h*$r), $width, $height);
                }

                try {
                    Image::fix_orientation($image_p, $imageTmpName);
                    Image::fix_orientation($image_t, $imageTmpName);
                } catch (\Exception $e){}
                switch ($imageType){
                    case 'png':
                        imagepng($image_p, $filepath);
                        imagepng($image_t, $thumbPath);
                        break;
                    case 'jpeg':
                        imagejpeg($image_p, $filepath);
                        imagejpeg($image_t, $thumbPath);
                        break;
                    case 'gif':
                        imagegif($image_p, $filepath);
                        imagegif($image_t, $thumbPath);
                        break;
                    default:
                        throw new UserException('unknown image type');
                        break;
                }

            } catch (\Exception $e){
                throw new UserException('Upload error: ' . $e->getMessage());
            }
            try {
                $model->gallery_id = $extraData['gallery_id'];
                $model->name = $imageName;
                $model->validate();
                $model->save();
            } catch (\Exception $e){
                return ('DB save error: ' . $e->getMessage());
            }

            return true;
        } else
            return 'nothing to upload';

    }

    // Создём альбом
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Gallery();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('app', 'create gallery'),
                    'content' => $this->renderPartial('@gallery-views/create', [
                        'model' => $model,
                    ]),
                ];
            } else if ($model->load($request->post()) && $model->validate()) {
                $model->name = Html::encode($model->name);
                $model->date = date('Y-m-d H:i:s');
                if($model->save()) {
                    $alias = Yii::getAlias('@webroot/img/gallery/' . Translator::rus2translit($model->name));
                    try {
                        //если создавать рекурсивно, то работает через раз хз почему.
                        $old = umask(0);
                        mkdir($alias, 0777, true);
                        chmod($alias, 0777);
                        mkdir($alias . '/thumb', 0777);
                        chmod($alias . '/thumb', 0777);
                        umask($old);
                    } catch (\Exception $e){
                        return(Yii::t('app', 'create gallery') . ' ' . $alias . ' - ' . $e->getMessage());
                    }
                    return [
                        'forceReload' => true,
                        'forceClose' => true,
                        'hideActionButton' => true,
                        'title' => Yii::t('app', 'create gallery'),
                        'content' => '<span class="text-success">' . Yii::t('app', 'success') . '</span>'
                    ];
                } else{
                    return [
                        'title' => Yii::t('app', 'create gallery'),
                        'content' => $this->renderPartial('@gallery-views/create', [
                            'model' => $model,
                        ]),
                    ];
                }
            } else {
                return [
                    'title' => Yii::t('app', 'create gallery'),
                    'content' => $this->renderPartial('create', [
                        'model' => $model,
                    ]),
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->gallery_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldName = $model->name;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('app', 'update gallery'),
                    'content' => $this->renderPartial('@gallery-views/update', [
                        'model' => $model,
                    ]),
                ];
            } else if ($model->load($request->post()) && $model->validate()) {
                $model->name = Html::encode($model->name);
                if ($model->save()) {
                    $oldAlias = Yii::getAlias('@webroot/img/gallery/' . Translator::rus2translit($oldName));
                    $newAlias = Yii::getAlias('@webroot/img/gallery/' . Translator::rus2translit($model->name));
                    if($oldAlias != $newAlias) {
                        try {
                            rename($oldAlias, $newAlias);
                        } catch (\Exception $e) {
                            return(Yii::t('app', 'failed to rename directory') . ' ' . $oldAlias . ' - ' . $e->getMessage());
                        }
                    }
                    return [
                        'forceReload' => true,
                        'hideActionButton' => true,
                        'title' => Yii::t('app', 'gallery') . ' - ' . $model->name,
                        'content' => '<span class="text-success">' . Yii::t('app', 'success') . '</span>',
                    ];
                } else{
                    return [
                        'title' => "Редактирование Галереи - " . $model->name,
                        'content' => $this->renderPartial('@gallery-views/update', [
                            'model' => $model,
                        ]),
                        'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::button('Сохранить', ['class' => 'btn btn-primary', 'type' => "submit"])
                    ];
                }
            }else {
                return [
                    'title' => "Gallery Edit - " . $model->name,
                    'content' => $this->renderPartial('@gallery-views/update', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer' => Html::button('Закрыть', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Сохранить', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->gallery_id]);
            } else {
                return $this->render('@gallery-views/update', [
                    'model' => $model,
                ]);
            }
        }
    }

    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $galleryId = $model->gallery_id;
        $dir = Yii::getAlias('@webroot/img/gallery/' . Translator::rus2translit($model->name));
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

    public function actionPhotosDelete()
    {
        $request = Yii::$app->request;
        $photoIds = $request->post('ids'); // Array or selected records primary keys
        $photoModels = GalleryPhoto::findAll($photoIds);
        if(empty($photoModels)) return null;
        $galleryModel = $this->findModel($photoModels[0]->gallery_id);
        $dir = Yii::getAlias('@webroot/img/gallery/' . Translator::rus2translit($galleryModel->name));
        foreach ($photoModels as $photo){
            try{
                unlink($dir . '/' . $photo->name);
                unlink($dir . '/thumb/' . $photo->name);
            } catch (\Exception $e){
                echo('Не удалось удалить файл ' . $photo->name . ' - ' . $e->getMessage());
            }
        }
        GalleryPhoto::deleteAll(['photo_id' => $photoIds]);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return true;
        } else {
            return $this->redirect(['index']);
        }

    }
}