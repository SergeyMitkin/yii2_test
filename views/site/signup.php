<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.10.2020
 * Time: 1:56
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

// Регистрируем CSS file
$this->registerCssFile('css/signup.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><span class="fill-form-request">Заполните поля, чтобы зарегистрироваться:</span></p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>