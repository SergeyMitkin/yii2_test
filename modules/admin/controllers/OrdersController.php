<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 27.02.2021
 * Time: 10:44
 */

namespace app\modules\admin\controllers;

use app\assets\AdminOrdersConfirmedAsset;
use app\assets\AdminOrdersIndexAsset;
use app\models\tables\Users;
use Yii;
use app\models\tables\Orders;
use app\models\filters\OrdersFilter;
use app\models\Email;
use app\models\tables\Servers;
use yii\web\Controller;
use yii\base\Event;


class OrdersController extends Controller
{
    // Страница с новыми заказами
    public function actionIndex()
    {
        $user = new Users();
        $user->isAdmin();

        $request = Yii::$app->request;
        $model_orders = new Orders();

        // При обновлении статуса заказа, отправляем пользователю email
        Event::on(Orders::class, Orders::EVENT_AFTER_UPDATE, function ($event){

            $model_email = new Email();
            $model_email->confirmOrderEmail($event);
        });

        // Принимаем или удаляем заказы через аякс
        if ($request->isAjax){

            if ($request->get()['action'] === 'confirm'){

                $model_orders->confirmOrders($request->get()['id']);
            }

            elseif ($request->get()['action'] === 'cancel'){

                $model_orders->cancelOrders($request->get()['id']);
            }
        }

        $ordersSearchModel = new OrdersFilter();
        $ordersDataProvider = $ordersSearchModel->search(Yii::$app->request->queryParams);

        AdminOrdersIndexAsset::register(Yii::$app->getView());

        return $this->render('index', [
            'ordersSearchModel' => $ordersSearchModel,
            'ordersDataProvider' => $ordersDataProvider
        ]);
    }

    // Страница принятых заказов
    public function actionConfirmed(){

        $ordersSearchModel = new OrdersFilter();
        $ordersDataProvider = $ordersSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('confirmed', [
            'ordersSearchModel' => $ordersSearchModel,
            'ordersDataProvider' => $ordersDataProvider,
        ]);
    }

}