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
 * @property int $status
 * @property int $semester
 * @property int $mhs_id
 * @property int $dosen_id
 * @property int $topik_id
 *
 * @property DetailPkl[] $detailPkls
 * @property LogPkl[] $logPkls
 * @property Dosen $dosen
 * @property Mahasiswa $mhs
 * @property MitraPkl $mitra
 * @property TopikPkl $topik
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
    // public function behaviors() {
    //     return [
    //         BlameableBehavior::className(),
    //         TimestampBehavior::className(),
    //     ];
    // }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'mulai', 'selesai'], 'safe'],
            [['tanggal', 'mulai', 'selesai'], 'date','format' => 'd-M-yyyy'],
            [['mitra_id', 'status', 'semester', 'mhs_id', 'dosen_id', 'topik_id'], 'default', 'value' => null],
            [['mitra_id', 'status', 'semester', 'mhs_id', 'dosen_id', 'topik_id'], 'integer'],
            [['dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['dosen_id' => 'id']],
            [['mhs_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['mhs_id' => 'mhsid']],
            [['mitra_id'], 'exist', 'skipOnError' => true, 'targetClass' => MitraPkl::className(), 'targetAttribute' => ['mitra_id' => 'id']],
            [['topik_id'], 'exist', 'skipOnError' => true, 'targetClass' => TopikPkl::className(), 'targetAttribute' => ['topik_id' => 'id']],
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
            'status' => 'Status',
            'semester' => 'Semester',
            'mhs_id' => 'Nama Mahasiswa',
            'dosen_id' => 'Dosen',
            'topik_id' => 'Topik / Judul',
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
    public function getTopik()
    {
        return $this->hasOne(TopikPkl::className(), ['id' => 'topik_id']);
    }

    public function getViewMhsProdi()
    {
        return $this->hasOne(VwmahasiswaProdi::className(), ['mhsid' => 'mhs_id']);
    }
}
