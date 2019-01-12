<?php
namespace app\modules\pkl\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\VwmahasiswaProdi;
use app\models\Mahasiswa;
use app\models\PengajuanPkl;
use app\models\MitraPkl;
use app\models\KategoriIndustri;

class ProfilController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $userid = Yii::$app->user->identity->id;
        $useremail = Yii::$app->user->identity->email;
        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();
        $pengajuan = PengajuanPkl::find()
            ->where(['mhs_id' => $mahasiswa->mhsid])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        $tgl_mulai = Yii::$app->formatter->format($pengajuan->mulai,'date');
        $tgl_selesai = Yii::$app->formatter->format($pengajuan->selesai,'date');
        $mitra = MitraPkl::find()
            ->where(['id' => $pengajuan->mitra_id])
            ->one();
        $kategori = KategoriIndustri::find()
            ->where(['id' => $mitra->kategori_id])
            ->one();
        $sks = Mahasiswa::find()
            ->where(['mhsid' => $mahasiswa->mhsid])
            ->one();

        return $this->render('index', [
            'mahasiswa' => $mahasiswa,
            'pengajuan' => $pengajuan,
            'useremail' => $useremail,
            'mitra' => $mitra,
            'kategori' => $kategori,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai'=> $tgl_selesai,
            'sks'=> $sks,

        ]);
    }

}
