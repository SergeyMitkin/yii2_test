<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 05.03.2021
 * Time: 12:37
 */

namespace app\commands;


use yii\web\Controller;

class RbacController extends Controller
{

    public function actionInit()
    {
        $am = Yii::$app->authManager;

        $admin = $am->createRole('admin');
        $admin->description = 'Администратор';

        $am->add($admin);

        $permission_admin_access = $am->createPermission('adminAccess');
        $permission_signup_access = $am->createPermission('signupAccess');

        $am->add($permission_admin_access);
        $am->add($permission_signup_access);

        $am->addChild($admin, $permission_admin_access);
        $am->addChild($admin, $permission_signup_access);

        $am->assign($admin, 3);
    }
}