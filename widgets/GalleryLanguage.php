<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 30.07.2021
 * Time: 23:01
 */

namespace app\widgets;

use onmotion\gallery\Gallery;
use yii\helpers\Json;
use yii\web\JsExpression;

// Переопределяем метод виджета из вендора
class GalleryLanguage extends Gallery
{
    public function run()
    {
        if (empty($this->items)) {
            return null;
        }

        // Закоментируем вызов метода, так как с ним галерея не работает нигде, кроме хрома
        // $this->renderPreloader();
        $this->renderGallery();

        $options = [];
        foreach ($this->pluginOptions as $k => $v) {
            $options[$k] = new JsExpression($v);
        }
        $options = Json::encode($options);
        $view = self::getView();
        $view->registerJs(
            <<<JS
 onmotion.gallery('$this->id', $options);
JS
        );
    }

}