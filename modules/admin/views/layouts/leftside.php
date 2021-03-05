<?php

use adminlte\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
<?= Html::img('@web/img/user2-160x160.jpg', ['class' => 'img-circle', 'alt' => 'User Image']) ?>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?=
        Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 
                            'url' => ['/'], 'active' => $this->context->route == 'site/index'
                        ],
                        [
                            'label' => 'Заказы',
                            'icon' => 'fa fa-cart-plus',
                            'url' => '/#',
                            'items' => [
                                [
                                    'label' => 'Новые',
                                    'icon' => '',
                                    'url' => Url::to(['/admin/orders']),
				    'active' => $this->context->route == 'admin/orders/index'
                                ],
                                [
                                    'label' => 'Подтверждённые',
                                    'icon' => '',
                                    'url' => ['/admin/orders/confirmed'],
				    'active' => $this->context->route == 'admin/orders/confirmed'
                                ]
                            ]
                        ],
                        ['label' => 'Предоставленные серверы', 'icon' => 'fa fa-server',
                            'url' => ['/admin/servers/index'], 'active' => $this->context->route == 'admin/servers/index'
                        ],
                        ['label' => 'Тарифы', 'icon' => 'glyphicon glyphicon-stats',
                            'url' => ['/admin/rates/index'], 'active' => $this->context->route == 'admin/rates/index'
                        ],
                        [
                            'label' => 'Пользователи',
                            'icon' => 'fa fa-users',
                            'url' => ['/admin/users'],
                            'active' => $this->context->route == 'user/index',
                        ],
                        ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                        ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                    ],
                ]
        )
        ?>
        
    </section>
    <!-- /.sidebar -->
</aside>
