<?php

namespace app\modules\pkl\controllers;

use Yii;
use app\modules\pkl\models\DetailPkl;
use app\modules\pkl\models\DetailPklSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;
use app\modules\pkl\models\PengajuanPkl;
use app\modules\pkl\models\VwmahasiswaProdi;
use app\modules\pkl\models\MitraPkl;
use app\modules\pkl\utils\Roles;
use app\modules\pkl\models\Dosen;
use app\modules\pkl\models\Mahasiswa;


/**
 * DetailPklController implements the CRUD actions for DetailPkl model.
 */
class DetailPklController extends Controller
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
     * Lists all DetailPkl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetailPklSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $userid = Yii::$app->user->identity->id;

        // nampilin data sesuai user login
        if (Roles::currentRole($userid) == Roles::DOSEN) {
            $dosen = Dosen::find()
                ->where(['user_id' => $userid])
                ->one();
            $dataProvider->query->andWhere(['dosen_id' => $dosen->id]);
            $model = DetailPkl::find()
                ->where(['dosen_id' => $dosen->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'userid' => $userid,
                'model' => $model,
                'dosen' => $dosen,
            ]);
        }else if (Roles::currentRole($userid) == Roles::MHS) {
            $mahasiswa = VwmahasiswaProdi::find()
                ->where(['user_id' => $userid])
                ->one();

            $model = PengajuanPkl::find()
                ->where(['mhs_id' => $mahasiswa->mhsid])
                ->orderBy(['id' => SORT_DESC])
                ->one();  
            
            if($model != NULL){
                $tgl_mulai = Yii::$app->formatter->format($model->mulai, 'date');
                $tgl_selesai = Yii::$app->formatter->format($model->selesai, 'date');
    
                $mitra = MitraPkl::find()
                    ->where(['id' => $model->mitra_id])
                    ->one();
    
                $detailPkl = DetailPkl::find()
                    ->where(['pkl_id' => $model->id])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();
            }else{
                $mitra = NULL;
                $tgl_mulai = NULL;
                $tgl_selesai = NULL;
                $detailPkl = NULL;
            }
                
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'userid' => $userid,
                'model' => $model,
                'mahasiswa' => $mahasiswa,
                'mitra' => $mitra,
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'detailPkl' => $detailPkl
            ]);
        }

    }

    /**
     * Displays a single DetailPkl model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $userid = Yii::$app->user->identity->id;

        $mahasiswa1 = Mahasiswa::find()
            ->where(['mhsid' => $this->findModel($id)->pkl->viewMhsProdi->mhsid])
            ->one();

        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['mhsid' => $mahasiswa1->mhsid])
            ->one();

        $dosen = Dosen::find()
            ->where(['user_id' => $userid])
            ->one();

        $listPkl = PengajuanPkl::find()
            ->where(['mhs_id' => $mahasiswa->mhsid])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $tgl_mulai = Yii::$app->formatter->format($listPkl->mulai, 'date');
        $tgl_selesai = Yii::$app->formatter->format($listPkl->selesai, 'date');

        $mitra = MitraPkl::find()
            ->where(['id' => $listPkl->mitra_id])
            ->one();

        $detailPkl = DetailPkl::find()
            ->where(['pkl_id' => $listPkl->id])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'userid' => $userid,
            'mahasiswa' => $mahasiswa,
            'listPkl' => $listPkl,
            'dosen' => $dosen,
            'mitra' => $mitra,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'detailPkl' => $detailPkl
        ]);
    }

    /**
     * Creates a new DetailPkl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DetailPkl();

        $userid = Yii::$app->user->identity->id;
        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        $listPkl = PengajuanPkl::find()
            ->where(['mhs_id' => $mahasiswa->mhsid])
            ->orderBy(['id' => SORT_DESC])
            ->one();

        $mitra = MitraPkl::find()
            ->where(['id' => $listPkl->mitra_id])
            ->one();

        if ($model->load(Yii::$app->request->post())) {
            $laporan = UploadedFile::getInstance($model, 'laporan');
            if (!is_null($laporan)) {
                $model->laporan = $laporan->name;
                // $ext = end((explode(".", $laporan->name)));
                // generate a unique file name to prevent duplicate filenames
                // $model->image_web_filename = Yii::$app->security->generateRandomString() . ".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)                       
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/file-laporan/';
                $path = Yii::$app->params['uploadPath'] . $model->laporan;
                $laporan->saveAs($path);
            }
            $model->pkl_id = $listPkl->id;
            $model->dosen_id = $listPkl->dosen_id;
            $model->created_at = date('d-M-Y');
            $model->updated_at = date('d-M-Y');
            if ($model->save()) {
                return $this->redirect(['/pkl/detail-pkl']);
            } else {
                var_dump($model->getErrors());
                die();
            }
        }
        return $this->render('create', [
            'model' => $model,
            'userid' => $userid,
            'mahasiswa' => $mahasiswa,
            'listPkl' => $listPkl,
            'mitra' => $mitra,
        ]);
    }

    /**
     * Updates an existing DetailPkl model.
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

        if(Roles::currentRole($userid) == Roles::MHS){
            $listPkl = PengajuanPkl::find()
                ->where(['mhs_id' => $mahasiswa->mhsid])
                ->orderBy(['id' => SORT_DESC])
                ->one();
            $mitra = MitraPkl::find()
                ->where(['id' => $listPkl->mitra_id])
                ->one();
        }else{
            $mitra=NULL;
        }


        if ($model->load(Yii::$app->request->post())) {
            $laporan = UploadedFile::getInstance($model, 'laporan');
            if (!is_null($laporan)) {
                $model->laporan = $laporan->name;
                // $ext = end((explode(".", $laporan->name)));
                // generate a unique file name to prevent duplicate filenames
                // $model->image_web_filename = Yii::$app->security->generateRandomString() . ".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)                       
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/file-laporan/';
                $path = Yii::$app->params['uploadPath'] . $model->laporan;
                $laporan->saveAs($path);
            }
            if ($model->nilai_dosen != "" || $model->nilai_dosen != "") {
                $model->nilai_akhir = ($model->nilai_dosen + $model->nilai_mentor) / 2;
            }else{
                $model->nilai_akhir = null;
                $model->nilai_dosen = null;
                $model->nilai_mentor = null;
            }
            $model->updated_at = date('d-M-Y');
            if ($model->save()) {
                return $this->redirect(['/pkl/detail-pkl']);
            } else {
                var_dump($model->getErrors());
                die();
            }
        }

        return $this->render('update', [
            'model' => $model,
            'userid' => $userid,
            'mitra' => $mitra
        ]);
    }

    /**
     * Deletes an existing DetailPkl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/pkl/detail-pkl']);
    }

    /**
     * Finds the DetailPkl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetailPkl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetailPkl::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
