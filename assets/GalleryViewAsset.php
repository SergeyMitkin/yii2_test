<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 14.06.2021
 * Time: 2:13
 */

namespace app\assets;
use yii\web\AssetBundle;

class GalleryViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/gallery-view.css'
    ];

    public $js = [
        'js/ru.js', // Подключаем файл с русской локализацией инпута загрузки файлов
        'js/onmotion-gallery-language.js' // Подключаем файл для переключения языков в модальном окне удаления изображений
    ];

    public $depends = [
        GalleryIndexAsset::class
    ];

}