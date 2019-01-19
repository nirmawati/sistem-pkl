<?php

namespace app\modules\pkl\controllers;

use Yii;
use app\models\LogPkl;
use app\models\LogPklSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\VwmahasiswaProdi;
use app\models\PengajuanPkl;
use app\models\Dosen;
use app\modules\pkl\utils\Roles;

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
        $searchModel = new LogPklSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $userid = Yii::$app->user->identity->id;

        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();
        
        $dosen = Dosen::find()
            ->where(['user_id' => $userid])
            ->one();

        $pengajuanPkl = PengajuanPkl::find()
            ->where(['mhs_id' => $mahasiswa->mhsid])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $dataProvider->pagination = [
            'pageSize' => 10
        ];

        //nampilin data sesuai user login
        if (Roles::currentRole($userid) == Roles::DOSEN) {
            $dataProvider->query->andWhere(['dosen_id' => $dosen->id]);
            $model = LogPkl::find()
                ->where(['dosen_id' => $dosen->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();

        } elseif (Roles::currentRole($userid) == Roles::MHS) {
            $dataProvider->query->andWhere(['pkl_id' => $pengajuanPkl->id]);
            $model = LogPkl::find()
                ->where(['pkl_id' => $pengajuanPkl->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userid' => $userid,
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
            ->where(['mhs_id' => $mahasiswa->mhsid])
            ->one();

        if ($model->load(Yii::$app->request->post())) {
            $model->pkl_id = $pengajuanPkl->id;
            $model->dosen_id = $pengajuanPkl->dosen_id;
            // return $this->redirect(['view', 'id' => $model->id]);
            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

        return $this->redirect(['index']);
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

//     public function actionPdf($id) {
//         $model = $this->findModel($id);
//         $absensi = LogP::findOne(['id' => $model->ruangan_id]);
//         $jamkeAwal = Jamke::findOne(['id' => $model->jamke_awal_id]);
//         $jamkeAkhir = Jamke::findOne(['id' => $model->jamke_akhir_id]);
//         $content = $this->renderPartial('_pdf', [
//             'model' => $model,
//             'ruangan' => $ruangan,
//             'jamawal' => $jamkeAwal,
//             'jamakhir' => $jamkeAkhir,
//         ]);
//         $pdf = new Pdf([
//             'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
//             'content' => $content,
// //            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
//             'cssInline' => '.kv-heading-1{font-size:18px}',
//             'options' => [
//                 'title' => 'Peminjaman Ruangan',
//                 'subject' => 'Peminjaman Ruangan STT Terpadu Nurul Fikri'
//             ],
//             'methods' => [
//                 'SetHeader' => ['STT Terpadu Nurul Fikri||Dibuat: ' . date("r")],
//                 'SetFooter' => ['Peminjaman Ruangan STT Terpadu Nurul Fikri'],
//                 //'SetFooter' => ['|Page {PAGENO}|'],
//             ]
//         ]);
//         return $pdf->render();
//     }
}
