<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kategori_industri".
 *
 * @property int $id
 * @property string $nama
 * @property int $prodi_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Prodi $prodi
 * @property MitraPkl[] $mitraPkls
 */
class KategoriIndustri extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori_industri';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prodi_id'], 'default', 'value' => null],
            [['created_at', 'updated_at'],'safe'],
            [['prodi_id'], 'integer'],
            [['nama'], 'string', 'max' => 60],
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
            'nama' => 'Kategori PKL',
            'prodi_id' => 'Prodi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getMitraPkls()
    {
        return $this->hasMany(MitraPkl::className(), ['kategori_id' => 'id']);
    }
}
