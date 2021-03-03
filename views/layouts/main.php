<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    $items = [
        ['label' => '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Главная', 'url' => ['/site/index']]
    ];
    if(Yii::$app->user->isGuest){
        $items[]=['label' => '<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Вход', 'url' => ['/site/login', 'login' => 'users']];
        $items[]=['label' => 'Регистрация', 'url' => ['/site/signup']];
    }
    else{
        $items[]=['label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Личный кабинет', 'url' => ['/account/index']];
        $items[]='<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выход (' . Yii::$app->user->identity->name . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    $items[]=['label' => '<span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Галерея', 'url' => ['/gallery/']];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
        'encodeLabels' => false
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="pull-left">
            <p>Изображение <a href="https://pixabay.com/ru/users/bsdrouin-5016447/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=2402637">Bethany Drouin</a> с сайта <a href="https://pixabay.com/ru/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=2402637">Pixabay</a></p>
            <p>Изображение <a href="https://pixabay.com/ru/users/peggy_marco-1553824/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1834091">Peggy und Marco Lachmann-Anke</a> с сайта <a href="https://pixabay.com/ru/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1834091">Pixabay</a></p>
            <p>&copy; <span><?= Yii::$app->name ?></span> <?= date('Y') ?></p>
        </div>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
