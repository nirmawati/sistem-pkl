<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "list_mahasiswa_pkl".
 *
 * @property int $id
 * @property int $mahasiswa_id
 * @property int $kegiatan_id
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 *
 * @property Mahasiswa $mahasiswa
 * @property KegiatanPkl $kegiatan
 */
class ListMahasiswaPkl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'list_mahasiswa_pkl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mahasiswa_id', 'kegiatan_id'], 'integer'],
            [['tgl_mulai', 'tgl_selesai'], 'safe'],
            [['mahasiswa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['mahasiswa_id' => 'id']],
            [['kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => KegiatanPkl::className(), 'targetAttribute' => ['kegiatan_id' => 'id']],
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
            'kegiatan_id' => 'Kegiatan ID',
            'tgl_mulai' => 'Tanggal Mulai',
            'tgl_selesai' => 'Tanggal Selesai',
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
    public function getKegiatan()
    {
        return $this->hasOne(KegiatanPkl::className(), ['id' => 'kegiatan_id']);
    }
}
