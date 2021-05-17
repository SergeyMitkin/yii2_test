<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 19.03.2021
 * Time: 16:21
 */

namespace app\assets;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/Главная.css'
    ];
    public $js = [
        'js/site-index.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        JqueryAsset::class
    ];

}