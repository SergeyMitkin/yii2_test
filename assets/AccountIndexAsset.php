<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 02.06.2021
 * Time: 1:28
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AccountIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/account-index.css'
    ];
    public $js = [
        'js/account-index.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        JqueryAsset::class
    ];
}