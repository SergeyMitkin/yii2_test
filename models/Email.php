<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 18.10.2020
 * Time: 18:39
 */

namespace app\models;


use yii\base\Model;
use Yii;

class Email extends Model
{
    // Отправляем email
    public function contact($send_to, $subject, $body, $send_from = 'admin@test.ru'){

        Yii::$app->mailer->compose()
            ->setTo($send_to)
            ->setFrom($send_from)
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();
    }

    public function sendEmail($event){
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

        $this->contact($email, $subject, $body);
    }
}