<?php

namespace app\modules\pkl\models;

use Yii;

/**
 * This is the model class for table "log_pkl".
 *
 * @property int $id
 * @property int $pkl_id
 * @property string $tanggal
 * @property string $jam_masuk
 * @property string $jam_pulang
 * @property string $kegiatan
 * @property int $ket
 * @property int $dosen_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PengajuanPkl $pkl
 */
class LogPkl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_pkl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkl_id', 'ket', 'dosen_id'], 'default', 'value' => null],
            [['pkl_id', 'ket', 'dosen_id'], 'integer'],
            [['tanggal', 'jam_masuk', 'jam_pulang','created_at', 'updated_at'], 'safe'],
            [['kegiatan'], 'string'],
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
            'pkl_id' => 'Mahasiswa',
            'tanggal' => 'Tanggal',
            'jam_masuk' => 'Jam Masuk',
            'jam_pulang' => 'Jam Pulang',
            'kegiatan' => 'Kegiatan',
            'ket' => 'Keterangan',
            'dosen_id' => 'Dosen Pembimbing',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
