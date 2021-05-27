<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 19.03.2021
 * Time: 16:21
 */

namespace app\assets;
use yii\web\AssetBundle;
//use yii\web\JqueryAsset;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/login.css'
    ];
    public $js = [
        //'js/site-index.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset'
        //'yii\web\YiiAsset',
        //JqueryAsset::class
    ];

}