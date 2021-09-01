<?php

namespace app\modules\admin\controllers;

use app\models\tables\Users;
use Yii;
use app\models\LoginForm;
use yii\web\Controller;
use app\assets\AdminLoginAsset;

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

        // Проверяем логин администратора
        $model = new LoginForm();
        $login = 'admin@test.ru';
        $model->scenario = $model::SCENARIO_LOGIN_ADMIN;

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->response->redirect(['/admin/orders']);
        }

        AdminLoginAsset::register(Yii::$app->getView());

        return $this->render('login', [
            'model' => $model,
            'login' => $login
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return Yii::$app->response->redirect(['/admin/']);
    }
}
