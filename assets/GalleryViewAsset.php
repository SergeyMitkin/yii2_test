<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 14.06.2021
 * Time: 2:13
 */

namespace app\assets;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class GalleryViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/gallery-view.css'
    ];

    public $js = [
        //'js/gallery-view.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        JqueryAsset::class
    ];

}