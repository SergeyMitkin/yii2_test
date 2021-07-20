<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 20.07.2021
 * Time: 22:41
 */

namespace app\components;

use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface

{

    public $supportedLanguages = ['en-US', 'ru-RU' ];

    public function bootstrap($app){

        $cookieLanguage = $app->request->cookies['language'];

        if(isset($cookieLanguage) && in_array($cookieLanguage, $this->supportedLanguages)){

            $app->language = $app->request->cookies['language'];

        }

    }

}