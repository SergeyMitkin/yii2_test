<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $defaultRoute = 'site';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors(){
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['adminAccess'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['admin/site'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    \Yii::$app->response->redirect(['admin']);
                },
            ],
        ];
    }
}
