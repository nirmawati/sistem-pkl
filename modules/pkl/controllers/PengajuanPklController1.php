<?php

namespace app\modules\pkl\controllers;

use Yii;
use app\models\PengajuanPkl;
use app\models\PengajuanPklSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\VwmahasiswaProdi;

/**
 * PengajuanPklController implements the CRUD actions for PengajuanPkl model.
 */
class PengajuanPklController extends Controller
{
    public $layout = '@app/views/layouts/column1';
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
     * Lists all PengajuanPkl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PengajuanPklSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $userid = Yii::$app->user->identity->id;
        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        $dataProvider->pagination = [
            'pageSize' => 10
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    /**
     * Displays a single PengajuanPkl model.
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
     * Creates a new PengajuanPkl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PengajuanPkl();

        $userid = Yii::$app->user->identity->id;
        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->mhs_id = $mahasiswa->mhsid;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'mahasiswa' => $mahasiswa
        ]);
    }


    /**
     * Updates an existing PengajuanPkl model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    // public function actionDetailmhs()
    // {
    //     $userid = Yii::$app->user->identity->id;
    //     $mahasiswa = VwmahasiswaProdi::find()
    //         ->select('nama')
    //         ->where(['user_id' => $userid])
    //         ->one();


    //     return $this->render('detailmhs', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //         'mahasiswa' => $mahasiswa,
    //     ]);
    // }

    /**
     * Deletes an existing PengajuanPkl model.
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
     * Finds the PengajuanPkl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PengajuanPkl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PengajuanPkl::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

