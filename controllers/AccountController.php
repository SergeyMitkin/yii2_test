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
use Yii;
use yii\web\Controller;
use app\models\tables\Orders;
use app\models\Email;
use yii\base\Event;
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
            'model_orders' => $model_orders,
        ]);
    }
}