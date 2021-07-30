<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2021
 * Time: 22:32
 */

namespace app\assets;


use onmotion\gallery\FileInputAsset;

class FileInputAssetLanguage extends FileInputAsset
{
    public $js = [
        'js/fileinput.min.js',
        'js/locales/ru.js' // Подключаем файл для перевода на русский
    ];
}