<?php

namespace app\modules\pkl\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $mhsid
 * @property string $nim
 * @property int $thn_masuk
 * @property double $ipk
 * @property int $total_sks
 * @property string $no_ijazah
 * @property string $tgl_lulus
 * @property int $camaba_id
 * @property int $prodi_id
 * @property int $status_id
 * @property int $peminatan_id
 * @property string $kode_rombel
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $id_sk
 * @property int $batas_studi
 * @property int $status_awal_id
 * @property int $nilai_sas
 * @property string $foto
 * @property string $email
 *
 * @property AbsenMahasiswa[] $absenMahasiswas
 * @property BimbinganPa[] $bimbinganPas
 * @property Khs[] $khs
 * @property Krs[] $krs
 * @property Camaba $camaba
 * @property Prodi $prodi
 * @property Rombel $kodeRombel
 * @property SkPmb $sk
 * @property StatusAwal $statusAwal
 * @property StatusMahasiswa $status
 * @property User $user
 * @property PengajuanPkl[] $pengajuanPkls
 * @property PenilaianKelas[] $penilaianKelas
 * @property PesertaKelas[] $pesertaKelas
 * @property PesertaUjian[] $pesertaUjians
 * @property SasMhs[] $sasMhs
 * @property Transkrip[] $transkrips
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thn_masuk', 'total_sks', 'camaba_id', 'prodi_id', 'status_id', 'peminatan_id', 'user_id', 'created_by', 'updated_by', 'id_sk', 'batas_studi', 'status_awal_id', 'nilai_sas'], 'default', 'value' => null],
            [['thn_masuk', 'total_sks', 'camaba_id', 'prodi_id', 'status_id', 'peminatan_id', 'user_id', 'created_by', 'updated_by', 'id_sk', 'batas_studi', 'status_awal_id', 'nilai_sas'], 'integer'],
            [['ipk'], 'number'],
            [['tgl_lulus', 'created_at', 'updated_at'], 'safe'],
            [['nim', 'no_ijazah'], 'string', 'max' => 20],
            [['kode_rombel'], 'string', 'max' => 6],
            [['foto'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 40],
            [['nim'], 'unique'],
            [['camaba_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camaba::className(), 'targetAttribute' => ['camaba_id' => 'id']],
            [['prodi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['prodi_id' => 'id']],
            [['kode_rombel'], 'exist', 'skipOnError' => true, 'targetClass' => Rombel::className(), 'targetAttribute' => ['kode_rombel' => 'kode']],
            [['id_sk'], 'exist', 'skipOnError' => true, 'targetClass' => SkPmb::className(), 'targetAttribute' => ['id_sk' => 'id']],
            [['status_awal_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusAwal::className(), 'targetAttribute' => ['status_awal_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusMahasiswa::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mhsid' => 'Mhsid',
            'nim' => 'Nim',
            'thn_masuk' => 'Thn Masuk',
            'ipk' => 'Ipk',
            'total_sks' => 'Total Sks',
            'no_ijazah' => 'No Ijazah',
            'tgl_lulus' => 'Tgl Lulus',
            'camaba_id' => 'Camaba ID',
            'prodi_id' => 'Prodi ID',
            'status_id' => 'Status ID',
            'peminatan_id' => 'Peminatan ID',
            'kode_rombel' => 'Kode Rombel',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'id_sk' => 'Id Sk',
            'batas_studi' => 'Batas Studi',
            'status_awal_id' => 'Status Awal ID',
            'nilai_sas' => 'Nilai Sas',
            'foto' => 'Foto',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsenMahasiswas()
    {
        return $this->hasMany(AbsenMahasiswa::className(), ['mhsid' => 'mhsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBimbinganPas()
    {
        return $this->hasMany(BimbinganPa::className(), ['mhsid' => 'mhsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKhs()
    {
        return $this->hasMany(Khs::className(), ['nim' => 'nim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKrs()
    {
        return $this->hasMany(Krs::className(), ['nim' => 'nim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamaba()
    {
        return $this->hasOne(Camaba::className(), ['id' => 'camaba_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(Prodi::className(), ['id' => 'prodi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeRombel()
    {
        return $this->hasOne(Rombel::className(), ['kode' => 'kode_rombel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSk()
    {
        return $this->hasOne(SkPmb::className(), ['id' => 'id_sk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusAwal()
    {
        return $this->hasOne(StatusAwal::className(), ['id' => 'status_awal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StatusMahasiswa::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajuanPkls()
    {
        return $this->hasMany(PengajuanPkl::className(), ['mhs_id' => 'mhsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaianKelas()
    {
        return $this->hasMany(PenilaianKelas::className(), ['mhs_id' => 'mhsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesertaKelas()
    {
        return $this->hasMany(PesertaKelas::className(), ['mhs_id' => 'mhsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesertaUjians()
    {
        return $this->hasMany(PesertaUjian::className(), ['mhs_id' => 'mhsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSasMhs()
    {
        return $this->hasMany(SasMhs::className(), ['mhs_id' => 'mhsid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranskrips()
    {
        return $this->hasMany(Transkrip::className(), ['mhs_id' => 'mhsid']);
    }
}
