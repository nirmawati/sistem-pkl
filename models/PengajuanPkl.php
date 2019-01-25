<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pengajuan_pkl".
 *
 * @property int $id
 * @property string $tanggal
 * @property int $mitra_id
 * @property string $mulai
 * @property string $selesai
 * @property string $semester
 * @property string $topik
 * @property int $mhs_id
 * @property int $dosen_id
 * @property int $status_pelaksanaan
 * @property int $status_kegiatan
 * @property int $status_surat
 * @property string $created_at
 * @property string $updated_at
 *
 * @property DetailPkl[] $detailPkls
 * @property LogPkl[] $logPkls
 * @property Dosen $dosen
 * @property Mahasiswa $mhs
 * @property MitraPkl $mitra
 * @property StatusPkl $statusPelaksanaan
 * @property StatusPkl $statusKegiatan
 * @property StatusPkl $statusSurat
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
            [['tanggal', 'mulai', 'selesai', 'created_at', 'updated_at'], 'safe'],
            [['mitra_id', 'mhs_id', 'dosen_id', 'status_pelaksanaan', 'status_kegiatan', 'status_surat'], 'default', 'value' => null],
            [['mitra_id', 'mhs_id', 'dosen_id', 'status_pelaksanaan', 'status_kegiatan', 'status_surat'], 'integer'],
            [['semester', 'topik'], 'string', 'max' => 255],
            [['dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['dosen_id' => 'id']],
            [['mhs_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['mhs_id' => 'mhsid']],
            [['mitra_id'], 'exist', 'skipOnError' => true, 'targetClass' => MitraPkl::className(), 'targetAttribute' => ['mitra_id' => 'id']],
            [['status_pelaksanaan'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPkl::className(), 'targetAttribute' => ['status_pelaksanaan' => 'id']],
            [['status_kegiatan'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPkl::className(), 'targetAttribute' => ['status_kegiatan' => 'id']],
            [['status_surat'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPkl::className(), 'targetAttribute' => ['status_surat' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal Pengajuan',
            'mitra_id' => 'Perusahaan / Instansi',
            'mulai' => 'Tanggal Mulai',
            'selesai' => 'Tanggal Selesai',
            'semester' => 'Semester',
            'topik' => 'Topik',
            'mhs_id' => 'Nama Mahasiswa',
            'dosen_id' => 'Dosen Pembimbing',
            'status_pelaksanaan' => 'Status Pengajuan',
            'status_kegiatan' => 'Status Kegiatan',
            'status_surat' => 'Status Pengantar',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPkls()
    {
        return $this->hasMany(DetailPkl::className(), ['pkl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogPkls()
    {
        return $this->hasMany(LogPkl::className(), ['pkl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosen()
    {
        return $this->hasOne(Dosen::className(), ['id' => 'dosen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMhs()
    {
        return $this->hasOne(Mahasiswa::className(), ['mhsid' => 'mhs_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitra()
    {
        return $this->hasOne(MitraPkl::className(), ['id' => 'mitra_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPelaksanaan()
    {
        return $this->hasOne(StatusPkl::className(), ['id' => 'status_pelaksanaan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusKegiatan()
    {
        return $this->hasOne(StatusPkl::className(), ['id' => 'status_kegiatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusSurat()
    {
        return $this->hasOne(StatusPkl::className(), ['id' => 'status_surat']);
    }
    
    public function getViewMhsProdi()
    {
        return $this->hasOne(VwmahasiswaProdi::className(), ['mhsid' => 'mhs_id']);
    }
}
