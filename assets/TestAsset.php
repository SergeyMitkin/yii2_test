<?php

namespace app\assets;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class TestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        //'css/signup.css',
    ];

    public $js = [
        'js/test.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        JqueryAsset::class
    ];
}