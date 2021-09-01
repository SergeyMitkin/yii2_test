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

    public function orderRateEmail($event){

        $order_id = $event->sender->id;
        $user = $event->sender->user;
        $email = $user->email;
        $username = $user->name;
        $rate = $event->sender->rate;
        $rate_name = (Yii::$app->language->value == 'en-UK') ? $rate->ru_name : $rate->en_name;
        $rate_price = $rate->price;

        $subject = Yii::t("app", "server order");
        $body = Yii::t("app", "dear") . ' ' . $username . ', ' . Yii::t("app", "you ordered") . ' ' . $rate_name .
            ' ' . Yii::t("app", "for") . ' ' . $rate_price . ' $. ' . Yii::t("app", "order") . ' № ' . $order_id . '. '
                . Yii::t("app", "wait confirmation");

        $this->contact($email, $subject, $body);
    }

    public function confirmOrderEmail($event){

        $order_id = $event->sender->id;
        $user = $event->sender->user;
        $email = $user->email;
        $username = $user->name;

        $subject = Yii::t("app", "order confirmation");
        $body = Yii::t("app", "dear") . ' ' . $username . '. ' . Yii::t("app", "your order") . ' № ' . $order_id . Yii::t("app", "confirmed");

        $this->contact($email, $subject, $body);
    }
}