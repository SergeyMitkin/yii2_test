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
use app\models\Email;
use app\models\tables\Servers;
use yii\web\Controller;
use yii\base\Event;


class OrdersController extends Controller
{
    // Страница с новыми заказами
    public function actionIndex()
    {
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

        if ($request->isPjax){
            // Принимаем заказ
            if($request->get('action') === 'confirm'){

                if ($model_orders->confirmOrder($request->get('id'))){
                    $model_servers = new Servers();
                    $order = $model_orders::findOne($order_id);
                    $user_id = $order->user_id;
                    $rate_id = $order->rate_id;

                    $model_servers->setServer($rate_id, $user_id, $order_id);

                    if ($request->get('page') !== NULL){
                        return $this->redirect( Yii::app()->createUrl('/admin/orders',array('page'=>$request->get('page'))));
                    } else {
                        return $this->redirect('/admin/orders');
                    }
                }
            }
            // Отменяем заказ
            else if ($request->get('action') === 'cancel'){

                $model_orders->cancelOrder($order_id);

                if ($request->get('page') !== NULL){
                    return $this->redirect( Yii::app()->createUrl('/admin/orders',array('page'=>$request->get('page'))));
                } else {
                    return $this->redirect('/admin/orders');
                }
            }
        }

        $ordersSearchModel = new OrdersFilter();
        $ordersDataProvider = $ordersSearchModel->search(Yii::$app->request->queryParams);

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