<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\StatusPkl;
use app\models\KategoriIndustri;
use app\models\User;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SeedController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        //create a view table(vwmahasiswa_prodi)
        // Yii::$app->getDb()->createCommand("CREATE VIEW vwmahasiswa_prodi AS 
        // SELECT  a.mhsid, a.user_id, a.nim, a.thn_masuk, b.nama, c.nama AS prodi 
        // FROM mahasiswa a INNER JOIN camaba b ON a.camaba_id = b.id 
        // INNER JOIN prodi c ON a.prodi_id = c.id");

        //status Pkl
        $statuses = ['Ditolak', 'Menunggu', 'Selesai', 'Diterima', 'Sedang PKL', 'Tidak Di Proses'];
        foreach($statuses as $status) {
            $statusPkl = new StatusPkl();
            $statusPkl->nama = $status;
            $statusPkl->save();
        }

        //update password for user(misna) with password(hady)
        // $passwordHash = '$2y$12$Nn/iT6/TQzAwae0u8C4weelj9HaJVc5KrQaOH7A6sD2klLxRFKQx.';
        // $misnaId = 54;
        // $userMisna = User::find()
        //             ->where(['id' => $misnaId])
        //             ->one();
        // $userMisna->password = $passwordHash;
        // $userMisna->save();
    }
}
