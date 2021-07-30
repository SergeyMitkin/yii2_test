<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2021
 * Time: 22:32
 */

namespace app\assets;

use onmotion\gallery\FileInputAsset;

// Переводим на русский язык процесс загружки файлов
class FileInputAssetLanguage extends FileInputAsset
{
    public $js = [
        'js/locales/ru.js' // Подключаем файл для перевода на русский
    ];
}