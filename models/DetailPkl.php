<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_pkl".
 *
 * @property int $id
 * @property int $pkl_id
 * @property string $deskripsi_tugas
 * @property string $departemen
 * @property int $kesesuaian
 * @property string $masalah
 * @property string $laporan
 * @property string $masukan_dosen
 * @property double $nilai_mentor
 * @property double $nilai_dosen
 * @property double $nilai_akhir
 *
 * @property PengajuanPkl $pkl
 */
class DetailPkl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pkl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkl_id', 'kesesuaian'], 'default', 'value' => null],
            [['pkl_id', 'kesesuaian'], 'integer'],
            [['deskripsi_tugas', 'masalah', 'laporan', 'masukan_dosen'], 'string'],
            [['nilai_mentor', 'nilai_dosen', 'nilai_akhir'], 'number'],
            [['departemen'], 'string', 'max' => 40],
            [['pkl_id'], 'exist', 'skipOnError' => true, 'targetClass' => PengajuanPkl::className(), 'targetAttribute' => ['pkl_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pkl_id' => 'Pkl ID',
            'deskripsi_tugas' => 'Deskripsi Tugas',
            'departemen' => 'Departemen',
            'kesesuaian' => 'Kesesuaian',
            'masalah' => 'Masalah',
            'laporan' => 'Laporan',
            'masukan_dosen' => 'Masukan Dosen',
            'nilai_mentor' => 'Nilai Mentor',
            'nilai_dosen' => 'Nilai Dosen',
            'nilai_akhir' => 'Nilai Akhir',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPkl()
    {
        return $this->hasOne(PengajuanPkl::className(), ['id' => 'pkl_id']);
    }
}
