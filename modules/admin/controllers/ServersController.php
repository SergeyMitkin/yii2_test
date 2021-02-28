<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 27.02.2021
 * Time: 10:44
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\tables\Orders;
use app\models\filters\OrdersFilter;
use app\models\filters\ServersFilter;
use app\models\Email;
use app\models\tables\Servers;
use yii\web\Controller;


class ServersController extends Controller
{
    // Страница принятых заказов
    public function actionIndex(){

        $serversSearchModel = new ServersFilter();
        $serversDataProvider = $serversSearchModel->search(Yii::$app->request->queryParams);

        // $ordersSearchModel = new OrdersFilter();
        // $ordersDataProvider = $ordersSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'serversSearchModel' => $serversSearchModel,
            'serversDataProvider' => $serversDataProvider,
            // 'ordersSearchModel' => $ordersSearchModel,
            // 'ordersDataProvider' => $ordersDataProvider,
        ]);
    }
}