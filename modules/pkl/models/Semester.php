<?php

namespace app\modules\pkl\models;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property int $id
 * @property string $nama
 *
 * @property PengajuanPkl[] $pengajuanPkls
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPengajuanPkls()
    {
        return $this->hasMany(PengajuanPkl::className(), ['semester_id' => 'id']);
    }
}
