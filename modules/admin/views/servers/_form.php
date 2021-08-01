<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Servers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rate_id')->label('Тариф')->dropDownList($rate_list) ?>

    <?= $form->field($model, 'user_id')->label('Логин(email) пользователя')->dropDownList($user_list) ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'model' => $model,
            'attribute' => 'date',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd - hh:ii:ss',
                'todayBtn' => true
            ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
