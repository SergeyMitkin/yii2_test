<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
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
        <meta name="keywords" content="Аренда выде​ленных серверов​">
        <meta name="description" content="">
        <meta name="page_type" content="np-template-header-footer-from-plugin">

        <title><?= Html::encode($this->title) ?></title>

        <script class="u-script" type="text/javascript" src="<?=Yii::getAlias('@web/js/nicepage.js')?>" defer=""></script>

        <meta name="generator" content="Nicepage 3.12.1, nicepage.com">

        <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
        <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Chenla:400">

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
        <link rel="canonical" href="index.html"> <!-- Посмотерть что за атрибуты -->
        <meta property="og:url" content="index.html"> <!-- Посмотерть что за атрибуты -->
        <?php $this->registerCsrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body data-home-page="Главная.html" data-home-page-title="Главная" class="u-body">
    <?php $this->beginBody() ?>
        <header class="u-clearfix u-header u-header" id="sec-ded9">
            <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">

                <a href="/" class="u-image u-logo u-image-1">
                    <img src="<?=Yii::getAlias("@web/images/default-logo.png")?>" class="u-logo-image u-logo-image-1">
                </a>

                <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1">
                    <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
                        <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
                            <svg>
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
                            </svg>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;">
                                        <rect y="1" width="16" height="2"></rect>
                                        <rect y="7" width="16" height="2"></rect>
                                        <rect y="13" width="16" height="2"></rect>
                                    </symbol>
                                </defs>
                            </svg>
                        </a>
                    </div>

                    <div class="u-nav-container">
                        <ul class="u-nav u-unstyled u-nav-1">
                            <li class="u-nav-item">
                                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/site/index" style="padding: 10px 20px;"><?= Yii::t("app", "menu home"); ?></a>
                            </li>
                            <?
                            if (!Yii::$app->user->isGuest){
                                echo '
                                    <li class="u-nav-item">
                                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/account/index" style="padding: 10px 20px;">' . Yii::t("app", "menu account") . '</a>
                                    </li>
                                ';
                            }
                            ?>
                            <li class="u-nav-item">
                                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/gallery" style="padding: 10px 20px;"><?= Yii::t("app", "menu gallery"); ?></a>
                            </li>
                            <?
                            if (Yii::$app->user->isGuest){
                                echo '
                                      <li class="u-nav-item">
                                           <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/site/login">' . Yii::t("app", "menu login") . '</a>
                                      </li>
                                      <li class="u-nav-item">
                                           <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/site/signup">' .
                                           Yii::t("app", "menu signup") . '</a>
                                      </li>                                                          
                                ';
                            } else {
                                echo '<li class="u-nav-item">'
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        '<a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base">' . Yii::t("app", "menu logout") . '(' . Yii::$app->user->identity->name . ')' . '</a>', ['class' => 'btn-menu']
                                        )
                                    . Html::endForm();
                                '</li>';
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="u-nav-container-collapse">
                        <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                            <div class="u-sidenav-overflow">
                                <div class="u-menu-close"></div>

                                    <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                                        <li class="u-nav-item">
                                            <a class="u-button-style u-nav-link" href="/site/index"><?= Yii::t("app", "menu home") ?></a>
                                        </li>
                                        <?
                                        if (!Yii::$app->user->isGuest){
                                            echo '
                                                <li class="u-nav-item">
                                                    <a class="u-button-style u-nav-link" href="/account/index">' . Yii::t("app", "menu account") . '</a>
                                                </li>
                                            ';
                                        }
                                        ?>
                                        <li class="u-nav-item">
                                            <a class="u-button-style u-nav-link" href="/gallery"><?= Yii::t("app", "menu gallery") ?></a>
                                        </li>
                                        <?
                                        if (Yii::$app->user->isGuest){
                                            echo '
                                          <li class="u-nav-item">
                                               <a class="u-button-style u-nav-link" href="/site/login">' . Yii::t("app", "menu login") . '</a>
                                          </li>
                                          <li class="u-nav-item">
                                               <a class="u-button-style u-nav-link" href="/site/signup">' . Yii::t("app", "menu signup") . '</a>
                                          </li>                                                          
                                          ';
                                        } else {
                                            echo '<li class="u-nav-item">'
                                                . Html::beginForm(['/site/logout'], 'post')
                                                . Html::submitButton(
                                                    '<a class="u-button-style u-nav-link"></a>' . Yii::t("app", "menu logout") . '(' . Yii::$app->user->identity->name . ')'
                                                )
                                                . Html::endForm();
                                            '</li>';
                                        }
                                        ?>
                                        <li class="u-nav-item">
                                            <a class="u-button-style u-nav-link" href="/site/test"><?//= Yii::t("app", "menu home") ?>Тестовая страница</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
                    </div>
                </nav>
            </div>
        </header>

        <section class="u-border-2 u-border-grey-75 u-clearfix u-grey-90 u-valign-top u-section-1" id="carousel_baa4">

            <img class="u-image u-image-1" src="<?=Yii::getAlias("@web/images/80706e8709156a71eff417a4b5353bb19db3491e5f2a1c1dbd49e0f4a254a5b858124bfb19e6ab4f08a4620d99780d576d8c687380d2a245cd9fa1_12801.jpg")?>" data-image-width="1280" data-image-height="853">

            <div class="breadcrumb-div">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>

            <div class="language-div">
                <?php if(Yii::$app->language == 'ru-RU') : ?>

                    <a href="<?= Url::to(['/site/language', 'language' => 'en-UK']) ?>" ><img src="<?=Yii::getAlias('@web/images/united-kingdom.png')?>" class="img-lang" alt="English"> English</a>

                <?php else: ?>

                    <a href="<?= Url::to(['/site/language', 'language' => 'ru-RU']) ?>" ><img src="<?=Yii::getAlias('@web/images/russia.png')?>" class="img-lang" alt="Русский"> Русский</a>

                <?php endif; ?>
            </div>

            <div class="u-align-right u-container-style u-group u-palette-2-base u-shape-rectangle u-group-1">
                <div class="u-container-layout u-valign-middle-sm u-container-layout-4">
                    <h2 class="u-align-center u-custom-font u-text u-text-7"><?= Yii::t("app", "site title"); ?></h2>
                </div>
            </div>

            <div class="page-content">
                <?= $content ?>
            </div>

        </section>

        <footer class="u-align-left u-clearfix u-footer u-grey-80 u-footer" id="sec-aed1">

            <div class="u-clearfix u-sheet u-sheet-1">
                <p class="u-text u-text-1"><?= Yii::t("app", "images ​from") ?> <a href="https://www.freepik.com/photos/people" class="u-border-1 u-border-white u-btn u-button-link u-button-style u-none u-text-body-alt-color u-btn-1" target="_blank">Freepik</a>
                </p>
            </div>

            <section class="u-backlink u-clearfix u-grey-80">
                <a class="u-link" href="https://nicepage.com/website-mockup" target="_blank">
                    <span>Website Mockup</span>
                </a>
                <p class="u-text">
                    <span><?= Yii::t("app", "created with") ?></span>
                </p>
                <a class="u-link" href="https://nicepage.com/" target="_blank">
                    <span>Website Builder Software</span>
                </a>.
            </section>
        </footer>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
