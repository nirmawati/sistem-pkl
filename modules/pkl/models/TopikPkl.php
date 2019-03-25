<?php

namespace app\modules\pkl\models;

use Yii;

/**
 * This is the model class for table "topik_pkl".
 *
 * @property int $id
 * @property string $nama
 *
 * @property PengajuanPkl[] $pengajuanPkls
 */
class TopikPkl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'topik_pkl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Topik / Judul',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajuanPkls()
    {
        return $this->hasMany(PengajuanPkl::className(), ['topik_id' => 'id']);
    }
}
