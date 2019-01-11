<?php
namespace app\modules\pkl\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\VwmahasiswaProdi;
use app\models\Mahasiswa;

class ProfilController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $userid = Yii::$app->user->identity->id;
        $mahasiswa = VwmahasiswaProdi::find()
            ->where(['user_id' => $userid])
            ->one();

        $mahasiswa1 = Mahasiswa::find()
            ->where(['user_id' => $userid])
            ->one();

        return $this->render('index', [
            'mahasiswa' => $mahasiswa,
            'mahasiswa1' => $mahasiswa1
        ]);
    }

}
