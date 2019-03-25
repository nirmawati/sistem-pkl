<?php

namespace app\modules\pkl\models;

use Yii;

/**
 * This is the model class for table "vwmahasiswa_prodi".
 *
 * @property int $mhsid
 * @property int $user_id
 * @property string $nim
 * @property int $thn_masuk
 * @property string $nama
 * @property string $prodi
 */
class VwmahasiswaProdi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vwmahasiswa_prodi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mhsid', 'user_id', 'thn_masuk'], 'default', 'value' => null],
            [['mhsid', 'user_id', 'thn_masuk'], 'integer'],
            [['nim'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 50],
            [['prodi'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mhsid' => 'Mhsid',
            'user_id' => 'User ID',
            'nim' => 'Nim',
            'thn_masuk' => 'Thn Masuk',
            'nama' => 'Nama',
            'prodi' => 'Prodi',
        ];
    }
}
