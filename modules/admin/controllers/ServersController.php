<?php

namespace app\modules\admin\controllers;

use app\models\tables\Rates;
use app\models\tables\Users;
use Yii;
use app\models\tables\Servers;
use app\models\filters\ServersFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServersController implements the CRUD actions for Servers model.
 */
class ServersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Servers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServersFilter();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Servers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new Servers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $rate_list = ArrayHelper::map(Rates::find()->all(), 'id', 'name');
        $user_list = ArrayHelper::map(Users::find()->all(), 'id', 'email');

        return $this->render('create', [
            'model' => $model,
            'rate_list' => $rate_list,
            'user_list' => $user_list
        ]);
    }
    */
    /**
     * Updates an existing Servers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $rate_list = ArrayHelper::map(Rates::find()->all(), 'id', 'ru_name');
        $user_list = ArrayHelper::map(Users::find()->all(), 'id', 'email');

        return $this->render('update', [
            'model' => $model,
            'rate_list' => $rate_list,
            'user_list' => $user_list
        ]);
    }

    /**
     * Deletes an existing Servers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Servers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Servers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
