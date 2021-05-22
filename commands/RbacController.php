<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 05.03.2021
 * Time: 12:37
 */

namespace app\commands;


use yii\console\Controller;

class RbacController extends Controller
{
    // Создаём роль администратора и прикрепляем её к пользователю
    public function actionInit()
    {
        $am = \Yii::$app->authManager;

        $admin = $am->createRole('admin');
        $admin->description = 'Администратор';

        $am->add($admin);

        $permission_admin_access = $am->createPermission('adminAccess');

        $am->add($permission_admin_access);

        $am->addChild($admin, $permission_admin_access);

        $am->assign($admin, 1);
    }
}