<?php

namespace app\modules\ls_admin\controllers;

use app\modules\ls_admin\models\Contamination;
use Yii;
use app\modules\ls_admin\models\Factory;
use app\modules\ls_admin\models\FactorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FactoryController implements the CRUD actions for Factory model.
 */
class FactoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'admin';

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
     * Lists all Factory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FactorySearch(['user_id'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Factory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Factory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Factory();
        $model->user_id = Yii::$app->user->id;
        $contamination = new Contamination();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $contamination->factory_id = $model->id;
            if ($contamination->load(Yii::$app->request->post()) && $contamination->save()) {
                if (isset($_POST['from_date'])){
                    $contamination->created_at =  strtotime($_POST['from_date']);
                    $contamination->updated_at =   strtotime($_POST['from_date']);
                    $contamination->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'contamination' => $contamination,
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'contamination' => $contamination,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Factory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $contamination_old = Contamination::findOne(['factory_id'=>$id]);
        $contamination = new Contamination();

        $contamination->h = $contamination_old->h;
        $contamination->C = $contamination_old->C;
        $contamination->d = $contamination_old->d;
        $contamination->T = $contamination_old->T;
        $contamination->v = $contamination_old->v;
        $contamination->factory_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save() && $contamination->load(Yii::$app->request->post()) && $contamination->save()) {
            if (isset($_POST['from_date'])){
                $contamination->created_at =  strtotime($_POST['from_date']);
                $contamination->updated_at =   strtotime($_POST['from_date']);
                $contamination->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'contamination' => $contamination,
            ]);
        }
    }

    /**
     * Deletes an existing Factory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Factory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Factory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Factory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
