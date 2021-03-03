<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\tables\Rates;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionRbac()
    {
        /*
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
         */
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Rates();
        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $login = Yii::$app->request->get()['login'];

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();

        // Админ заходит через форму входа для адиминистратора
        if ($login == 'users'){
            $model->scenario = $model::SCENARIO_LOGIN_USERS;
            $title = 'Вход';
            $login = '';
            $login_label = 'Логин (email)';

            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return Yii::$app->response->redirect(['account/index']);
            }

        } else if ($login == 'admin'){
            $model->scenario = $model::SCENARIO_LOGIN_ADMIN;
            $title = 'Вход для администратора';
            $login = 'admin@test.ru';
            $login_label = 'Логин админа (email)';

            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return Yii::$app->response->redirect(['admin/new']);
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'title' => $title,
            'login' => $login,
            'login_label' => $login_label
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($user = $model->signup()) {

                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


}
