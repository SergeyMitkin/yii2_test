<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Servers */

$this->title = 'Создать Сервер';
$this->params['breadcrumbs'][] = ['label' => 'Серверы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'rate_list' => $rate_list,
        'user_list' => $user_list
    ]) ?>

</div>
