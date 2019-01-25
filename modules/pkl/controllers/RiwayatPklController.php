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
use app\models\DetailPkl;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * PengajuanPklController implements the CRUD actions for PengajuanPkl model.
 */
class RiwayatPklController extends Controller
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
            $dataProvider->query->andWhere(['dosen_id' => $dosen->id,'status_kegiatan'=>3]);
            $model = PengajuanPkl::find()
                ->where(['dosen_id' => $dosen->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();

        }else if (Roles::currentRole($userid) == Roles::BAAK) {
            $dataProvider->query->andWhere(['status_kegiatan'=>3]);
            $model = PengajuanPkl::find()
                ->orderBy(['id' => SORT_DESC])
                ->one();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userid' => $userid,
            'mahasiswa' => $mahasiswa,
            'detailPkl' => $detailPkl,
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
        $detailPkl = DetailPkl::find()
            ->where(['pkl_id'=> $id])
            ->one();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'detailPkl' => $detailPkl,
        ]);
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
