<?php

namespace app\modules\pkl\controllers;

use Yii;
use app\models\PengajuanPkl;
use app\models\PengajuanPklSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\VwmahasiswaProdi;
use app\models\Dosen;
use app\models\Mahasiswa;
use app\modules\pkl\utils\Roles;

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

        $dosen = Dosen::find()
            ->where(['user_id' => $userid])
            ->all();

        $dosenProdi = Dosen::find()
            ->where(['homebase_id' => $mahasiswa1->prodi_id])
            ->one();

        $dataProvider->pagination = [
            'pageSize' => 10
        ];

        if (Roles::currentRole($userid) == Roles::DOSEN) {
            $dataProvider->query->andWhere(['dosen_id' => $dosen->id]);
            $model = PengajuanPkl::find()
                ->where(['dosen_id' => $userid])
                ->one();
        } elseif (Roles::currentRole($userid) == Roles::MHS) {
            $dataProvider->query->andWhere(['mhs_id' => $mahasiswa->mhsid]);
            $model = PengajuanPkl::find()
                ->where(['mhs_id' => $mahasiswa->mhsid])
                ->one();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userid' => $userid,
            'mahasiswa' => $mahasiswa,
            'model' => $model
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
        $mahasiswaProdi = Mahasiswa::find()
            ->where(['user_id' => $userid])
            ->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->mhs_id = $mahasiswa->mhsid;
            $model->status_surat = 2;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'mahasiswaProdi' => $mahasiswaProdi,
            'userid' => $userid,
            'mahasiswa' => $mahasiswa,
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
        $userid = Yii::$app->user->identity->id;
        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        $mahasiswaProdi = Mahasiswa::find()
            ->where(['user_id' => $userid])
            ->one();

        if ($model->load(Yii::$app->request->post())) {
            if($model->status_surat = 4){
                $model->status_pelaksanaan = 2;
            }elseif($model->status_pelaksanaan = 4){
                $model->status_kegiatan = 5;
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'mahasiswa' => $mahasiswa,
            'userid' => $userid,
            'mahasiswaProdi' => $mahasiswaProdi,
        ]);
    }

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
