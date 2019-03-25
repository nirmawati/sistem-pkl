<?php

namespace app\modules\pkl\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property string $nama Nama
 * @property string $jk Jenis Kelamin
 * @property string $tmp_lahir Tempat Lahir
 * @property string $tgl_lahir Tanggal Lahir
 * @property string $alamat Alamat
 * @property string $noktp No KTP
 * @property string $email Email
 * @property string $agama Agama
 * @property string $telpon No Telpon/Handphone
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $nik NIK
 * @property int $orgid Organisasi
 * @property string $gelar_depan Gelar Depan
 * @property string $gelar_belakang Gelar Belakang
 * @property string $tglmulai_kerja Tanggal Mulai Kerja
 * @property int $aktif Aktif
 * @property string $golongan Golongan
 * @property int $id
 * @property string $foto
 * @property string $nidn NIDN
 * @property int $jafung_id Jafung
 * @property int $statusdosen_id Status Dosen
 * @property string $goldikti Golongan Dikti
 * @property int $homebase_id Homebase
 * @property string $cv
 *
 * @property AbsenDosen[] $absenDosens
 * @property Jafung $jafung
 * @property Prodi $homebase
 * @property StatusDosen $statusdosen
 * @property JadwalUjian[] $jadwalUjians
 * @property Kelas[] $kelas
 * @property Kelas[] $kelas0
 * @property Matakuliah[] $matakuliahs
 * @property PengajuanPkl[] $pengajuanPkls
 * @property Rombel[] $rombels
 * @property YudisiumMhs[] $yudisiumMhs
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'nik'], 'required'],
            [['jk', 'agama', 'cv'], 'string'],
            [['tgl_lahir', 'created_at', 'updated_at', 'tglmulai_kerja'], 'safe'],
            [['user_id', 'created_by', 'updated_by', 'orgid', 'aktif', 'jafung_id', 'statusdosen_id', 'homebase_id'], 'default', 'value' => null],
            [['user_id', 'created_by', 'updated_by', 'orgid', 'aktif', 'jafung_id', 'statusdosen_id', 'homebase_id'], 'integer'],
            [['nama'], 'string', 'max' => 50],
            [['tmp_lahir', 'noktp'], 'string', 'max' => 30],
            [['alamat', 'foto'], 'string', 'max' => 100],
            [['email', 'telpon'], 'string', 'max' => 40],
            [['nik', 'gelar_belakang'], 'string', 'max' => 20],
            [['gelar_depan'], 'string', 'max' => 6],
            [['golongan', 'nidn', 'goldikti'], 'string', 'max' => 10],
            [['jafung_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jafung::className(), 'targetAttribute' => ['jafung_id' => 'id']],
            [['homebase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['homebase_id' => 'id']],
            [['statusdosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusDosen::className(), 'targetAttribute' => ['statusdosen_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nama' => 'Nama',
            'jk' => 'Jk',
            'tmp_lahir' => 'Tmp Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'alamat' => 'Alamat',
            'noktp' => 'Noktp',
            'email' => 'Email',
            'agama' => 'Agama',
            'telpon' => 'Telpon',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'nik' => 'Nik',
            'orgid' => 'Orgid',
            'gelar_depan' => 'Gelar Depan',
            'gelar_belakang' => 'Gelar Belakang',
            'tglmulai_kerja' => 'Tglmulai Kerja',
            'aktif' => 'Aktif',
            'golongan' => 'Golongan',
            'id' => 'ID',
            'foto' => 'Foto',
            'nidn' => 'Nidn',
            'jafung_id' => 'Jafung ID',
            'statusdosen_id' => 'Statusdosen ID',
            'goldikti' => 'Goldikti',
            'homebase_id' => 'Homebase ID',
            'cv' => 'Cv',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsenDosens()
    {
        return $this->hasMany(AbsenDosen::className(), ['dosen_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJafung()
    {
        return $this->hasOne(Jafung::className(), ['id' => 'jafung_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomebase()
    {
        return $this->hasOne(Prodi::className(), ['id' => 'homebase_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusdosen()
    {
        return $this->hasOne(StatusDosen::className(), ['id' => 'statusdosen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwalUjians()
    {
        return $this->hasMany(JadwalUjian::className(), ['pengawas_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['dosen_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas0()
    {
        return $this->hasMany(Kelas::className(), ['asdos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliahs()
    {
        return $this->hasMany(Matakuliah::className(), ['dosen_pengampu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajuanPkls()
    {
        return $this->hasMany(PengajuanPkl::className(), ['dosen_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRombels()
    {
        return $this->hasMany(Rombel::className(), ['dosenpa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYudisiumMhs()
    {
        return $this->hasMany(YudisiumMhs::className(), ['dosen_pembimbing_id' => 'id']);
    }
}
