<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property string $visi
 * @property string $misi
 * @property string $alamat
 * @property string $website
 * @property string $telpon
 * @property string $email
 * @property string $nama
 * @property int $idorg
 * @property string $kode
 * @property int $parent_orgid
 * @property string $pejabat
 * @property string $nik_pejabat
 * @property string $nama_jabatan
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $id
 * @property string $akreditasi
 * @property string $nosk_banpt
 * @property string $tglsk_banpt
 * @property string $tglakhirsk_banpt
 * @property string $gelar
 * @property int $jenjang_id
 * @property int $fakultas_id
 * @property string $no_prodi
 *
 * @property Camaba[] $camabas
 * @property CamabaProdi[] $camabaProdis
 * @property Dosen[] $dosens
 * @property KalendarAkademik[] $kalendarAkademiks
 * @property KategoriIndustri[] $kategoriIndustris
 * @property Kelas[] $kelas
 * @property KelasProdi[] $kelasProdis
 * @property KurikulumMatakuliah[] $kurikulumMatakuliahs
 * @property Mahasiswa[] $mahasiswas
 * @property PaketKelas[] $paketKelas
 * @property PeminatanProdi[] $peminatanProdis
 * @property Fakultas $fakultas
 * @property Jenjang $jenjang
 * @property Rombel[] $rombels
 * @property Yudisium[] $yudisia
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visi', 'misi'], 'string'],
            [['parent_orgid', 'created_by', 'updated_by', 'jenjang_id', 'fakultas_id'], 'default', 'value' => null],
            [['parent_orgid', 'created_by', 'updated_by', 'jenjang_id', 'fakultas_id'], 'integer'],
            [['created_at', 'updated_at', 'tglsk_banpt', 'tglakhirsk_banpt'], 'safe'],
            [['alamat'], 'string', 'max' => 100],
            [['website', 'email'], 'string', 'max' => 40],
            [['telpon', 'nik_pejabat'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 60],
            [['kode', 'no_prodi'], 'string', 'max' => 10],
            [['pejabat', 'nama_jabatan', 'nosk_banpt'], 'string', 'max' => 30],
            [['akreditasi'], 'string', 'max' => 1],
            [['gelar'], 'string', 'max' => 6],
            [['fakultas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['fakultas_id' => 'id']],
            [['jenjang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jenjang::className(), 'targetAttribute' => ['jenjang_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'visi' => 'Visi',
            'misi' => 'Misi',
            'alamat' => 'Alamat',
            'website' => 'Website',
            'telpon' => 'Telpon',
            'email' => 'Email',
            'nama' => 'Nama',
            'idorg' => 'Idorg',
            'kode' => 'Kode',
            'parent_orgid' => 'Parent Orgid',
            'pejabat' => 'Pejabat',
            'nik_pejabat' => 'Nik Pejabat',
            'nama_jabatan' => 'Nama Jabatan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'id' => 'ID',
            'akreditasi' => 'Akreditasi',
            'nosk_banpt' => 'Nosk Banpt',
            'tglsk_banpt' => 'Tglsk Banpt',
            'tglakhirsk_banpt' => 'Tglakhirsk Banpt',
            'gelar' => 'Gelar',
            'jenjang_id' => 'Jenjang ID',
            'fakultas_id' => 'Fakultas ID',
            'no_prodi' => 'No Prodi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamabas()
    {
        return $this->hasMany(Camaba::className(), ['pilihan1_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCamabaProdis()
    {
        return $this->hasMany(CamabaProdi::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosens()
    {
        return $this->hasMany(Dosen::className(), ['homebase_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKalendarAkademiks()
    {
        return $this->hasMany(KalendarAkademik::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriIndustris()
    {
        return $this->hasMany(KategoriIndustri::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelasProdis()
    {
        return $this->hasMany(KelasProdi::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKurikulumMatakuliahs()
    {
        return $this->hasMany(KurikulumMatakuliah::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswas()
    {
        return $this->hasMany(Mahasiswa::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaketKelas()
    {
        return $this->hasMany(PaketKelas::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeminatanProdis()
    {
        return $this->hasMany(PeminatanProdi::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas()
    {
        return $this->hasOne(Fakultas::className(), ['id' => 'fakultas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenjang()
    {
        return $this->hasOne(Jenjang::className(), ['id' => 'jenjang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRombels()
    {
        return $this->hasMany(Rombel::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYudisia()
    {
        return $this->hasMany(Yudisium::className(), ['prodi_id' => 'id']);
    }
}
