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
}