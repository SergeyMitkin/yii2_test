<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.10.2020
 * Time: 1:56
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\app\assets\SignupAsset::register($this);

/*
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
*/
?>
<div class="site-signup col-lg-6 col-xl-4 col-md-6 col-sm-8 col-xs-10">

    <div class="title-div"><h2 class="title-h">Регистрация</h2></div>

    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-8\">{label}</div>\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'signup-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary signup-button', 'name' => 'signup-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>