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

        return $this->render('index', [
            'serversSearchModel' => $serversSearchModel,
            'serversDataProvider' => $serversDataProvider,
            'ordersSearchModel' => $ordersSearchModel,
            'ordersDataProvider' => $ordersDataProvider,
            'username' => $username,
            'model_rates' => $model_rates,
            'model_orders' => $model_orders,
        ]);
    }
}