<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\LoginForm;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class SiteController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->response->redirect(['admin/orders']);
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

}
