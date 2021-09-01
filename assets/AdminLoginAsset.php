<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 01.09.2021
 * Time: 1:58
 */

namespace app\assets;

use yii\web\AssetBundle;

class AdminLoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/admin-login.css'
    ];

    public $js = [
        //'js/admin-orders-index.js'
    ];

    public $depends = [
        AdminLteAsset::class
    ];
}