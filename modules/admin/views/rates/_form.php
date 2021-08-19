<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Rates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ru_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ru_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'en_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
