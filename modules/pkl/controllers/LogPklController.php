<?php

namespace app\modules\pkl\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use app\modules\pkl\models\LogPkl;
use app\modules\pkl\models\LogPklSearch;
use app\modules\pkl\models\VwmahasiswaProdi;
use app\modules\pkl\models\PengajuanPkl;
use app\modules\pkl\models\Dosen;
use app\modules\pkl\utils\Roles;
use app\modules\pkl\models\MitraPkl;
use app\modules\pkl\models\PengajuanPklSearch;


/**
 * LogPklController implements the CRUD actions for LogPkl model.
 */
class LogPklController extends Controller
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
     * Lists all LogPkl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pengajuanPkl;
        $userid = Yii::$app->user->identity->id;
        if (Roles::currentRole($userid) == Roles::DOSEN) {
            $searchModel = new PengajuanPklSearch();

        } elseif (Roles::currentRole($userid) == Roles::MHS) {
            $searchModel = new LogPklSearch();
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        $listPkl = PengajuanPkl::find()
            ->where(['mhs_id' => $mahasiswa->mhsid])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $dataProvider->pagination = [
            'pageSize' => 10
        ];

        //nampilin data sesuai user login
        if (Roles::currentRole($userid) == Roles::DOSEN) {
            $dosen = Dosen::find()
                ->where(['user_id' => $userid])
                ->one();

            $pengajuanPkl = PengajuanPkl::find()
                ->where([
                    'dosen_id' => $dosen->id,
                    'status_kegiatan' => 5
                ])
                ->orderBy(['id' => SORT_DESC])
                ->all();

            $dataProvider->query->andWhere(['dosen_id' => $dosen->id, 'status_kegiatan' => 5]);


            $model = LogPkl::find()
                ->where(['dosen_id' => $dosen->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();

        } elseif (Roles::currentRole($userid) == Roles::MHS) {
            $pengajuanPkl = PengajuanPkl::find()
                ->where(['mhs_id' => $mahasiswa->mhsid])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            $dataProvider->query->andWhere(['pkl_id' => $pengajuanPkl->id]);
            $model = LogPkl::find()
                ->where(['pkl_id' => $pengajuanPkl->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pengajuanPkl' => $pengajuanPkl,
            'userid' => $userid,
            'listPkl' => $listPkl,
        ]);
    }

    /**
     * Displays a single LogPkl model.
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

    public function actionDetail($id)
    {
        $searchModel = new LogPklSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andWhere(['pkl_id' => $id]);

        $pengajuanPkl = PengajuanPkl::find()
            ->where(['id' => $id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['mhsid' => $pengajuanPkl->mhs_id])
            ->one();

        $dataProvider->pagination = [
            'pageSize' => 10
        ];

        $model = LogPkl::find()
            ->where(['dosen_id' => $dosen->id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mahasiswa' => $mahasiswa,
            'id' => $id,
            'userid' => $userid,
        ]);
    }

    /**
     * Creates a new LogPkl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LogPkl();

        $userid = Yii::$app->user->identity->id;

        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        $pengajuanPkl = PengajuanPkl::find()
            ->where(['mhs_id' => $mahasiswa->mhsid, 'status_kegiatan' => 5])
            ->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->pkl_id = $pengajuanPkl->id;
            $model->dosen_id = $pengajuanPkl->dosen_id;
            $model->tanggal = date('d-M-Y');
            $model->created_at = date('d-M-Y');
            $model->updated_at = date('d-M-Y');
            // return $this->redirect(['view', 'id' => $model->id]);
            if ($model->save()) {
                return $this->redirect(['/pkl/log-pkl']);
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LogPkl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = date('d-M-Y');
            if ($model->save()) {
                return $this->redirect(['/pkl/log-pkl']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'mhs' => $mahasiswa,
        ]);
    }

    /**
     * Deletes an existing LogPkl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/pkl/log-pkl']);
    }

    /**
     * Finds the LogPkl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LogPkl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LogPkl::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Save view to PDF
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPdf()
    {
        $userid = Yii::$app->user->identity->id;

        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        $pengajuanPkl = PengajuanPkl::find()
            ->where(['mhs_id' => $mahasiswa->mhsid])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $mitraPkl = MitraPkl::find()
            ->where(['id' => $pengajuanPkl->mitra_id])
            ->one();

        $content = $this->renderPartial('_pdf', [
            'mahasiswa' => $mahasiswa,
            'mitraPkl' => $mitraPkl,
            'model' => LogPkl::find()->where(['pkl_id' => $pengajuanPkl->id])->all(),
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
            'content' => $content,
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => [
                'title' => 'FERGUSO',
                'subject' => 'MAGANG GITO LHO'
            ],
            'methods' => [
                'SetHeader' => ['STT Terpadu Nurul Fikri||Dibuat: ' . date("r")],
                'SetFooter' => ['PKL - STT Terpadu Nurul Fikri'],
            ]
        ]);
        return $pdf->render();
    }

}
