<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2021
 * Time: 13:44
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AdminOrdersIndexAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/admin-orders-index.css'
    ];

    public $js = [
        'js/admin-orders-index.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        JqueryAsset::class
    ];

}