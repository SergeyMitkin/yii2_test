<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 08.10.2020
 * Time: 23:34
 */

namespace app\controllers;

use app\models\filters\AccountOrdersFilter;
use app\models\filters\AccountServersFilter;
use app\models\tables\Rates;
use Yii;
use yii\web\Controller;
use app\models\tables\Orders;
use yii\filters\VerbFilter;

class AccountController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            // Разрешаем доступ к контроллеру только авторизованным пользователям
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    // Главная страница личного кабинета
    public function actionIndex()
    {
        $model_rates = new Rates();
        $model_orders = new Orders();

        $request = Yii::$app->request;
        $username = Yii::$app->user->identity->name;

        $serversSearchModel = new AccountServersFilter();
        $serversDataProvider = $serversSearchModel->search(Yii::$app->request->queryParams);

        $ordersSearchModel = new AccountOrdersFilter();
        $ordersDataProvider = $ordersSearchModel->search(Yii::$app->request->queryParams);

        // Определяем активную вкладку
        $active_li = ($request->get()['active_li'] !== NULL) ? $request->get()['active_li'] : 'servers';
        $this->view->registerJsVar('active_li', $active_li);

        $language = substr(Yii::$app->language, 0, 2);

        return $this->render('index', [
            'serversSearchModel' => $serversSearchModel,
            'serversDataProvider' => $serversDataProvider,
            'ordersSearchModel' => $ordersSearchModel,
            'ordersDataProvider' => $ordersDataProvider,
            'username' => $username,
            'model_rates' => $model_rates,
            'model_orders' => $model_orders,
            'language' => $language
        ]);
    }
}