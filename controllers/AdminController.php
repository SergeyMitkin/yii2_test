<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 13.10.2020
 * Time: 22:52
 */

namespace app\controllers;

use app\models\Email;
use app\models\tables\Orders;
use app\models\tables\Servers;
use yii\base\Event;
use yii\web\Controller;
use Yii;
use app\models\filters\AdminOrdersFilter;
use app\models\filters\AccountServersFilter;

class AdminController extends Controller
{
    // Страница новых заказов
    public function actionNew(){

        $request = Yii::$app->request;
        $order_id = $request->get()["id"];
        $model_orders = new Orders();

        // Событие при обновлении статуса заказа
        Event::on(Orders::class, Orders::EVENT_AFTER_UPDATE, function ($event){

            $order_id = $event->sender->id;
            $user = $event->sender->user;
            $email = $user->email;
            $username = $user->name;

            // Отправляем email пользователю
            $subject = 'Подтверждение заказа';
            $body = 'Уважаемый ' . $username . ', Ваш заказ № ' . $order_id . ' подтверждён.';

            $model_email = new Email();
            $model_email->contact($email, $subject, $body);
        });

        // Принимаем заказ через Pjax
        if ($request->isPjax){

            if ($model_orders->confirmOrder($order_id)){

                $model_servers = new Servers();
                $order = $model_orders::findOne($order_id);
                $user_id = $order->user_id;
                $rate_id = $order->rate_id;

                $model_servers->setServer($rate_id, $user_id, $order_id);
            }
        };

        $ordersSearchModel = new AdminOrdersFilter();
        $ordersDataProvider = $ordersSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('new', [
            'ordersSearchModel' => $ordersSearchModel,
            'ordersDataProvider' => $ordersDataProvider
        ]);
    }

    // Страница принятых заказов
    public function actionConfirmed(){

        $modal_servers = new Servers();
        $model_orders = new Orders();

        $serverQuery = $modal_servers->getServersWithRates();
        $orderQuery = $model_orders->getConfirmedOrders();

        return $this->render('confirmed', [
            'serverQuery' => $serverQuery,
            'orderQuery' => $orderQuery,
            'model_orders' => $model_orders,
        ]);
    }
}