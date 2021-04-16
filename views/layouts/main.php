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
<html lang="<?= Yii::$app->language ?>" style="font-size: 16px;">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="<?= Yii::$app->charset ?>">
      <!--  <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="keywords" content="Concept">
        <meta name="description" content="">
        <meta name="page_type" content="np-template-header-footer-from-plugin">

        <title><?= Html::encode($this->title) ?></title>

        <link rel="stylesheet" href="<?=Yii::getAlias('@web/css/nicepage.css')?>" media="screen">
        <link rel="stylesheet" href="<?=Yii::getAlias('@web/css/Главная.css')?>" media="screen">

        <script class="u-script" type="text/javascript" src="<?=Yii::getAlias('@web/js/jquery.js')?>" defer=""></script>
        <script class="u-script" type="text/javascript" src="<?=Yii::getAlias('@web/js/nicepage.js')?>" defer=""></script>

        <meta name="generator" content="Nicepage 3.9.0, nicepage.com">
        <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">



        <script type="application/ld+json">{
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "url": "index.html",
            "logo": "images/default-logo.png"
        }
        </script>
        <meta property="og:title" content="Главная">
        <meta property="og:type" content="website">
        <meta name="theme-color" content="#478ac9">
        <link rel="canonical" href="index.html">
        <meta property="og:url" content="index.html">
        <?php $this->registerCsrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body data-home-page="Главная.html" data-home-page-title="Главная" class="u-body">
    <?php $this->beginBody() ?>

    <header class="u-clearfix u-header u-header" id="sec-c886">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
            <a href="https://nicepage.com" class="u-image u-logo u-image-1">
                <img src="../images/default-logo.png" class="u-logo-image u-logo-image-1">
            </a>
            <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
                <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
                    <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
                        <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;"><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
                                </symbol>
                            </defs>
                        </svg>
                    </a>
                </div>
                <div class="u-nav-container">
                    <ul class="u-nav u-unstyled u-nav-1">
                        <li class="u-nav-item">
                            <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/site/index" style="padding: 10px 20px;">Главная</a>
                        </li>
                        <li class="u-nav-item">
                            <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/site/login" style="padding: 10px 20px;">Вход</a>
                        </li>
                        <li class="u-nav-item">
                            <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/site/signup" style="padding: 10px 20px;">Регистрация</a>
                        </li>
                        <li class="u-nav-item">
                            <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/account/index" style="padding: 10px 20px;">Личный кабинет</a>
                        </li>
                        <li class="u-nav-item">
                            <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/site/logout" style="padding: 10px 20px;">Выход</a>
                        </li>
                        <li class="u-nav-item">
                            <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/gallery/" style="padding: 10px 20px;">Галерея</a>
                        </li>
                    </ul>
                </div>
                <div class="u-nav-container-collapse">
                    <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                        <div class="u-sidenav-overflow">
                            <div class="u-menu-close"></div>
                            <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link" href="/site/index">Главная</a>
                                </li>
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link" href="/site/login">Вход</a>
                                </li>
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link" href="/site/signup">Регистрация</a>
                                </li>
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link" href="/account/index">Личный кабинет</a>
                                </li>
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link" href="/site/logout">Выход</a>
                                </li>
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link" href="/gallery/">Галерея</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="u-black u-menu-overlay u-opacity u-opacity-70">
                    </div>
                </div>
            </nav>
        </div>
    </header>



    <section class="u-clearfix u-palette-4-dark-3 u-section-1" id="carousel_f7c2">
        <img class="u-image u-image-1" src="../images/9a6156fc77ab7d52d9afd82eedb40927201c69167b3a78aebd8e2e5065c097249c5268425a3f5a59ca5afcd19beac63fe4b3cc0abda158c71b4405_1280.jpg" data-image-width="1280" data-image-height="853">
        <p class="u-align-right u-text u-text-1">Images from <a href="https://www.freepik.com/photos/people" class="u-border-1 u-border-white u-btn u-button-link u-button-style u-none u-text-body-alt-color u-btn-1">Freepik</a>
        </p>
        <div class="u-align-center u-list u-repeater u-list-1">
            <div class="u-container-style u-list-item u-repeater-item u-white u-list-item-1">
                <div class="u-container-layout u-similar-container u-container-layout-1">
                    <h2 class="u-text u-text-2">Concept</h2>
                    <p class="u-text u-text-3">Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
                </div>
            </div>
        </div>
    </section>


    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-1f7b"><div class="u-clearfix u-sheet u-sheet-1">
            <p class="u-small-text u-text u-text-variant u-text-1">Пример текста. Кликните, чтобы выбрать текстовый блок. Кликните еще раз или сделайте двойной клик, чтобы начать редактирование текста.</p>
        </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
        <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
            <span>Website Templates</span>
        </a>
        <p class="u-text">
            <span>created with</span>
        </p>
        <a class="u-link" href="https://nicepage.com/" target="_blank">
            <span>Website Builder Software</span>
        </a>.
    </section>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
