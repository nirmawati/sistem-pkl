<?php

namespace app\modules\pkl\models;

use Yii;

/**
 * This is the model class for table "mitra_pkl".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $kontak
 * @property string $telpon
 * @property string $email
 * @property int $status
 * @property int $kategori_id
 *
 * @property KategoriIndustri $kategori
 * @property PengajuanPkl[] $pengajuanPkls
 */
class MitraPkl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mitra_pkl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'kontak', 'telpon','email','status','kategori_id'], 'required'],
            [['status', 'kategori_id'], 'default', 'value' => null],
            [['status', 'kategori_id'], 'integer'],
            [['nama'], 'string', 'max' => 60],
            [['alamat'], 'string', 'max' => 100],
            [['kontak', 'email'], 'string', 'max' => 30],
            ['email', 'email'],
            [['telpon'], 'string', 'max' => 20],
            [['kategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => KategoriIndustri::className(), 'targetAttribute' => ['kategori_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Perusahaan / Instansi',
            'alamat' => 'Alamat',
            'kontak' => 'PIC',
            'telpon' => 'Telepon',
            'email' => 'Email',
            'status' => 'Status',
            'kategori_id' => 'Kategori ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(KategoriIndustri::className(), ['id' => 'kategori_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajuanPkls()
    {
        return $this->hasMany(PengajuanPkl::className(), ['mitra_id' => 'id']);
    }
}
