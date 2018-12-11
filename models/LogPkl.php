<?php

namespace app\models;

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
            [['pkl_id'], 'default', 'value' => null],
            [['pkl_id'], 'integer'],
            [['tanggal', 'jam_masuk', 'jam_pulang'], 'safe'],
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
            'pkl_id' => 'Pkl ID',
            'tanggal' => 'Tanggal',
            'jam_masuk' => 'Jam Masuk',
            'jam_pulang' => 'Jam Pulang',
            'kegiatan' => 'Kegiatan',
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
