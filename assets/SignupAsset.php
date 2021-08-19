<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 31.05.2021
 * Time: 22:32
 */

namespace app\assets;
use yii\web\AssetBundle;

class SignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/signup.css',
    ];

    public $js = [
        //'js/login.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];

}