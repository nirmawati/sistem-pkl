<?php

use yii\db\Migration;

/**
 * Handles the creation of table `detail_pkl`.
 */
class m190124_121336_create_detail_pkl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    // * @property int $id
    // * @property int $pkl_id
    // * @property string $deskripsi_tugas
    // * @property string $departemen
    // * @property int $kesesuaian
    // * @property string $masalah
    // * @property string $laporan
    // * @property string $masukan_dosen
    // * @property double $nilai_mentor
    // * @property double $nilai_dosen
    // * @property double $nilai_akhir
    // * @property int $dosen_id
    public function safeUp()
    {
        $this->createTable('detail_pkl', [
            'id' => $this->primaryKey(),
            'pkl_id'=>$this->integer(),
            'deskripsi_tugas'=>$this->text(),
            'departemen'=>$this->string(),
            'kesesuaian'=>$this->integer(),
            'masalah'=>$this->string(),
            'laporan'=>$this->string(),
            'masukan_dosen'=>$this->string(),
            'nilai_mentor'=>$this->double(),
            'nilai_dosen'=>$this->double(),
            'nilai_akhir'=>$this->double(),
            'dosen_id'=>$this->integer(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
        ]);

        $this->addForeignKey(
            'fk_pkl_id', 
            'detail_pkl', 'pkl_id', 
            'pengajuan_pkl', 'id', 
            'CASCADE', 'CASCADE');
        
        $this->addForeignKey(
            'fk_dosen_id', 
            'detail_pkl', 'dosen_id', 
            'dosen', 'id', 
            'CASCADE', 'CASCADE');
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('detail_pkl');
    }
}
