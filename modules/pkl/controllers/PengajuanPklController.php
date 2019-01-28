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
use yii\web\UploadedFile;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

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
            ->one();
 
        $dosenProdi = Dosen::find()
            ->where(['homebase_id' => $mahasiswa1->prodi_id])
            ->one();

        $dataProvider->pagination = [
            'pageSize' => 10
        ];
        
        //nampilin data sesuai user login
        if (Roles::currentRole($userid) == Roles::DOSEN) {
            $dataProvider->query->andWhere(['dosen_id' => $dosen->id]);
            $model = PengajuanPkl::find()
                ->where(['dosen_id' => $dosen->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();
                
        } elseif (Roles::currentRole($userid) == Roles::MHS) {
            $dataProvider->query->andWhere(['mhs_id' => $mahasiswa->mhsid]);
            $model = PengajuanPkl::find()
                ->where(['mhs_id' => $mahasiswa->mhsid])
                ->orderBy(['id' => SORT_DESC])
                ->one();
        }

        if (Yii::$app->request->post('hasEditable')) {
            $id = Yii::$app->request->post('editableKey');
            $status = PengajuanPkl::findOne($id);

            $out = Json::encode(['output' => '', 'message' => '']);
            $post = [];
            $posted = current($_POST['PengajuanPkl']);
            $post['PengajuanPkl'] = $posted;

            if ($status->load($post)) {

                $tempSurat = $status->status_surat;
                $tempPelaksanaan = $status->status_pelaksanaan;
                $tempKegiatan = $status->status_kegiatan;

                // if ($tempSurat == 3 && $tempPelaksanaan == 6) {
                //     $status->status_pelaksanaan = 2; //menunggu
                // } elseif ($tempPelaksanaan == 4) {
                //     $status->status_pelaksanaan = 4; //diterima
                //     $status->status_kegiatan = 5; //menunggu
                //     $status->status_surat = 3;
                // } elseif ($tempKegiatan == 3) {
                //     $status->status_kegiatan = 3; //selesai
                // }elseif ($tempSurat == 3 && $tempPelaksanaan == 1) {
                //     $status->status_kegiatan = 6; //tidak di proses
                // }
                // elseif ($tempSurat == 1||$tempSurat == 2) {
                //     $status->status_pelaksanaan = 6; //tidak di proses
                // }
                if ($tempSurat == 1 || $tempSurat==2){
                    $status->status_pelaksanaan = 6;
                    $status->status_kegiatan = 6;
                }elseif($tempSurat==3 && $tempPelaksanaan==6){
                    $status->status_pelaksanaan = 2;
                }elseif($tempPelaksanaan==1||$tempPelaksanaan==2){
                    $status->status_kegiatan = 6;
                }elseif($tempPelaksanaan==4 && $tempKegiatan==6){
                    $status->status_kegiatan = 5;//sedang pkl
                }
                $status->save();
                $output = 'Refresh untuk update';
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            echo $out;
            $this->refresh();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userid' => $userid,
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
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
            $model->tanggal = date('d-M-Y');
            $model->created_at = date('d-M-Y');
            $model->updated_at = date('d-M-Y');
            $model->status_surat = 2;
            $model->status_pelaksanaan = 6;
            $model->status_kegiatan = 6;
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

            //status surat pengantar -> status_surat
            //status pengajuan -> status_pelaksanaan
            //status kegiatan -> status_kegiatan

            // 1;"Ditolak"
            // 2;"Menunggu"
            // 3;"Selesai"
            // 4;"Diterima"
            // 5;"Sedang PKL"
            // 6;"Tidak diproses"

            $bukti = UploadedFile::getInstance($model, 'bukti');
            if (!is_null($bukti)) {
                $model->bukti = $bukti->name;
                // $ext = end((explode(".", $laporan->name)));
                // generate a unique file name to prevent duplicate filenames
                // $model->image_web_filename = Yii::$app->security->generateRandomString() . ".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)                       
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/file-bukti/';
                $path = Yii::$app->params['uploadPath'] . $model->bukti;
                $model->status_pelaksanaan = 4; //diterima
                $bukti->saveAs($path);
            }

            $tempSurat = $model->status_surat;
            $tempPelaksanaan = $model->status_pelaksanaan;
            $tempKegiatan = $model->status_kegiatan;

            if ($tempSurat == 3 && $tempPelaksanaan == 0) {
                $model->status_pelaksanaan = 2; //menunggu
            } elseif ($tempPelaksanaan == 4) {
                $model->status_pelaksanaan = 4; //diterima
                $model->status_kegiatan = 5; //menunggu
            } elseif ($tempKegiatan == 3) {
                $model->status_kegiatan = 3; //selesai
            }
            $model->updated_at = date('d-M-Y');

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
     * Download PengajualPkl() by mahasiswa
     * @param integer $id
     * @return mixed
     */
    public function actionDownload($id) {
        $pengajuanPkl = PengajuanPkl::find()->where(['id' => $id])->one();

        $content = $this->renderPartial('download', [
            'model' => $pengajuanPkl
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
