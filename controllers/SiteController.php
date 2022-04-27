<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\tables\Rates;
use app\models\tables\Orders;
use app\models\Email;
use yii\base\Event;
use yii\web\Cookie;

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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Rates();
        $model_orders = new Orders();

        // Передаём в переменные js информацию о пользователе
        if(Yii::$app->user->isGuest){
            $is_guest = 'guest';
        }else{
            $is_guest =  'authorized';
        }
        $this->view->registerJsVar('is_guest', $is_guest, 2);

        // Переменные для интренационализации
        $log_in_to_order = Yii::t("app", "log in to order");
        $this->view->registerJsVar('log_in_to_order', $log_in_to_order, 2);
        $to_order = Yii::t("app", "to order");
        $this->view->registerJsVar('to_order', $to_order, 2);
        $for = Yii::t("app", "for");
        $this->view->registerJsVar('for_', $for, 2);
        $error_alert = Yii::t("app", "error alert");
        $this->view->registerJsVar('error_alert', $error_alert, 2);
        $added_to_order= Yii::t("app", "added to order");
        $this->view->registerJsVar('added_to_order', $added_to_order, 2);

        if(\Yii::$app->request->isAjax){

            $rate_id = Yii::$app->request->get()['rate_id'];
            $rate_name = Yii::$app->request->get()['rate_name'];;
            $user_id = Yii::$app->user->identity->getId();

            // При выборе тарифа пользователем, отправляем email о создании заказа
            Event::on(Orders::class, Orders::EVENT_AFTER_INSERT, function ($event){

                $model_email = new Email();
                $model_email->orderRateEmail($event);

            });

            // Создаём заказ
            try{
                $model_orders->setOrder($rate_id, $user_id);

                $res['order'] = 'created';
                $res['rate_name'] = $rate_name;

                return json_encode($res);

            }catch (Exception $e){
                $res['order'] = 'refused';
                $res['message'] = $e->getName();
                return json_encode($res);
            }
        }

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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->response->redirect(['account/index']);
        }

        return $this->render('login', [
            'model' => $model
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

    /**
     * @return Response
     * Переключение языка
     */
    public function actionLanguage(){

        $language = Yii::$app->request->get('language');

        if(!$language == 'ru-RU' || !$language == 'en-UK'){
            return $this->redirect(Yii::$app->request->referrer);
        }

        Yii::$app->language = $language;

        $languageCookie = new Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30,
        ]);

        Yii::$app->response->cookies->add($languageCookie);

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionTest(){

        $captcha = '';
        $site_key = '6Lca5Z4fAAAAACFNANKMKoiWh_8iJuA-S9VHWCxv';
        $secret_key = '6Lca5Z4fAAAAALKJjkAAU0H99FVMC6UIVXSAXcEn';

        if (Yii::$app->request->isAjax){

            $captcha = $_POST['recaptcha'];

            function getCaptcha($secret_key, $captcha){
                $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $captcha);
                $return = json_decode($response);
                return $return;
            }

            $return = getCaptcha($secret_key, $captcha);
//            var_dump($return);

            if ($return->success == true && $return->score >= 0.5){
                echo 'success';
            } else {
                echo 'robot';
            }

        } else {
            return $this->render('test', [
                'site_key' => $site_key,
                'secret_key' => $secret_key
            ]);
        }

    }
}
