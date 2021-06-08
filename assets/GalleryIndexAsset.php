<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 07.06.2021
 * Time: 0:13
 */

namespace app\assets;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class GalleryIndexAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/gallery-index.css'
    ];

    public $js = [
        //'js/account-index.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        JqueryAsset::class
    ];

}