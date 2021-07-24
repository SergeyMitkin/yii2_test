<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 07.06.2021
 * Time: 0:13
 */

namespace app\assets;
use yii\web\AssetBundle;

class GalleryIndexAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/gallery-index.css'
    ];

    public $js = [
        //'js/gallery-index.js'
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];

}