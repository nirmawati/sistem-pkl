<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kegiatan_pkl".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $waktu_datang
 * @property string $waktu_pulang
 * @property string $kegiatan
 * @property string $materi
 * @property string $masukan
 * @property string $keterangan
 *
 * @property ListMahasiswaPkl[] $listMahasiswaPkls
 */
class KegiatanPkl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kegiatan_pkl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'waktu_datang', 'waktu_pulang'], 'safe'],
            [['kegiatan', 'materi', 'masukan', 'keterangan'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'waktu_datang' => 'Waktu Datang',
            'waktu_pulang' => 'Waktu Pulang',
            'kegiatan' => 'Kegiatan',
            'materi' => 'Materi',
            'masukan' => 'Masukan',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListMahasiswaPkls()
    {
        return $this->hasMany(ListMahasiswaPkl::className(), ['kegiatan_id' => 'id']);
    }
}
