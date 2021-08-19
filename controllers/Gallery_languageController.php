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
use onmotion\helpers\Translator;
use Yii;
use yii\web\Response;
use yii\helpers\Html;


// Переопределяем методы контроллера из вендора для перевода на русский язык
class Gallery_languageController extends DefaultController
{

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
                    $alias = Yii::getAlias('@app/web/img/gallery/' . Translator::rus2translit($model->name));
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
                    $oldAlias = Yii::getAlias('@app/web/img/gallery/' . Translator::rus2translit($oldName));
                    $newAlias = Yii::getAlias('@app/web/img/gallery/' . Translator::rus2translit($model->name));
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