<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 08.10.2020
 * Time: 23:34
 */

namespace app\controllers;

use app\models\tables\Servers;
use Yii;
use yii\web\Controller;
use app\models\tables\Orders;
use app\models\Email;
use yii\base\Event;
// use app\models\tables\Rates;

class AccountController extends Controller
{

    // Главная страница личного кабинета
    public function actionIndex()
    {
        $model_servers = new Servers();
        $model_orders = new Orders();

        $request = Yii::$app->request;
        $rate_id = $request->get()["id"];
        $user_id = Yii::$app->user->identity->getId();
        $username = Yii::$app->user->identity->name;

        // Если пришли по ссылке с заказа тарифа, добавляем заказ
        if ($rate_id != null){

            // Событие после добавления заказа
            Event::on(Orders::class, Orders::EVENT_AFTER_INSERT, function ($event){

                $order_id = $event->sender->id;
                $user = $event->sender->user;
                $email = $user->email;
                $username = $user->name;
                $rate = $event->sender->rate;
                $rate_name = $rate->name;
                $rate_price = $rate->price;

                // Отправляем email пользователю
                $subject = 'Заказ сервера';
                $body = 'Уважаемый ' . $username . ', Вы заказали ' . $rate_name .
                ' за ' . $rate_price . ' $. Номер заказа ' . $order_id . '.
                Дождитесь подтверждения администратором';

                $model_email = new Email();
                $model_email->contact($email, $subject, $body);

            });

            // Добавляем заказ
            $model_orders->setOrder($rate_id, $user_id);
            // Переходим на вкладку заказов
            $this->redirect(['index', array('active_li' => 'orders')]);
        };

        $serverQuery = $model_servers->getServersByUserId($user_id);
        $orderQuery = $model_orders->getOrdersByUserId($user_id);

        return $this->render('index', [
            'username' => $username,
            'serverQuery' => $serverQuery,
            'orderQuery' => $orderQuery,
            'model_orders' => $model_orders,
        ]);
    }

    // Страница с тарифами
    /*
    public function actionRates()
    {
        $model = new Rates();
        return $this->render('rates', [
            'title' => 'Тарифы',
            'model' => $model
        ]);
    }
    */
}