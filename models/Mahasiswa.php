<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $id
 * @property string $nim
 * @property string $nama
 * @property int $prodi_id
 * @property string $telp
 * @property string $tmpt_lahir
 * @property string $tgl_lahir
 *
 * @property ListMahasiswaPkl[] $listMahasiswaPkls
 * @property Prodi $prodi
 * @property PengajuanPkl[] $pengajuanPkls
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
            [['prodi_id'], 'integer'],
            [['tgl_lahir'], 'safe'],
            [['nim', 'nama', 'telp', 'tmpt_lahir'], 'string', 'max' => 45],
            [['prodi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['prodi_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nim' => 'Nim',
            'nama' => 'Nama',
            'prodi_id' => 'Prodi ID',
            'telp' => 'Telp',
            'tmpt_lahir' => 'Tmpt Lahir',
            'tgl_lahir' => 'Tgl Lahir',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListMahasiswaPkls()
    {
        return $this->hasMany(ListMahasiswaPkl::className(), ['mahasiswa_id' => 'id']);
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
    public function getPengajuanPkls()
    {
        return $this->hasMany(PengajuanPkl::className(), ['mahasiswa_id' => 'id']);
    }
}
