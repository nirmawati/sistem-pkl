<?php

use yii\db\Migration;

/**
 * Handles the creation of table `log_pkl`.
 */
class m190124_122304_create_log_pkl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    // * @property int $id
    // * @property int $pkl_id
    // * @property string $tanggal
    // * @property string $jam_masuk
    // * @property string $jam_pulang
    // * @property string $kegiatan
    // * @property int $ket
    // * @property int $dosen_id
    public function safeUp()
    {
        $this->createTable('log_pkl', [
            'id' => $this->primaryKey(),
            'pkl_id'=>$this->integer(),
            'tanggal'=>$this->date(),
            'jam_masuk'=>$this->time(),
            'jam_pulang'=>$this->time(),
            'kegiatan'=>$this->string(),
            'ket'=>$this->integer(),
            'dosen_id'=>$this->integer(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
        ]);
        $this->addForeignKey(
            'fk_pkl_id', 
            'log_pkl', 'pkl_id', 
            'pengajuan_pkl', 'id', 
            'CASCADE', 'CASCADE');
        
        $this->addForeignKey(
            'fk_dosen_id', 
            'log_pkl', 'dosen_id', 
            'dosen', 'id', 
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('log_pkl');
    }
}
