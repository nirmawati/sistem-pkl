<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengajuan_pkl".
 *
 * @property int $id
 * @property int $mahasiswa_id
 * @property string $alamat_pkl
 * @property string $tujuan_pengirim
 * @property string $topik_pkl
 * @property string $file_krs
 * @property string $file_transkip
 * @property int $status_id
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 *
 * @property Mahasiswa $mahasiswa
 * @property Status $status
 */
class PengajuanPkl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pengajuan_pkl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mahasiswa_id', 'status_id'], 'integer'],
            [['tgl_mulai', 'tgl_selesai'], 'safe'],
            [['alamat_pkl', 'tujuan_pengirim', 'topik_pkl', 'file_krs', 'file_transkip'], 'string', 'max' => 45],
            [['mahasiswa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['mahasiswa_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mahasiswa_id' => 'Mahasiswa ID',
            'alamat_pkl' => 'Alamat Pkl',
            'tujuan_pengirim' => 'Tujuan Pengirim',
            'topik_pkl' => 'Topik Pkl',
            'file_krs' => 'File Krs',
            'file_transkip' => 'File Transkip',
            'status_id' => 'Status ID',
            'tgl_mulai' => 'Tgl Mulai',
            'tgl_selesai' => 'Tgl Selesai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id' => 'mahasiswa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
