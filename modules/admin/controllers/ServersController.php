<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 27.02.2021
 * Time: 10:44
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\filters\ServersFilter;
use app\models\tables\Servers;
use yii\web\Controller;


class ServersController extends Controller
{
    // Страница принятых заказов
    public function actionIndex(){

        $serversSearchModel = new ServersFilter();
        $serversDataProvider = $serversSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'serversSearchModel' => $serversSearchModel,
            'serversDataProvider' => $serversDataProvider,
        ]);
    }
}