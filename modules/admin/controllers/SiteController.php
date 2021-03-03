<?php

namespace app\modules\admin\controllers;

use app\models\tables\Users;
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
        // Если admin авторизован, переходим на страницу заказов
        if(!Yii::$app->user->isGuest){
            $user = new Users();
            if ($user->isAdmin()){
                $this->redirect(['/admin/orders']);
            }
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->response->redirect(['/admin/orders']);
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }
}
