<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pengajuan_pkl`.
 */
class m190124_120023_create_pengajuan_pkl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // * @property int $id
        // * @property string $tanggal
        // * @property int $mitra_id
        // * @property string $mulai
        // * @property string $selesai
        // * @property int $semester
        // * @property int $mhs_id
        // * @property int $dosen_id
        // * @property int $status_pelaksanaan
        // * @property int $status_kegiatan
        // * @property int $status_surat
        // * @property string $topik
        $this->createTable('pengajuan_pkl', [
            'id' => $this->primaryKey(),
            'tanggal'=>$this->date(),
            'mitra_id' => $this->integer(),
            'mulai'=>$this->date(), 
            'selesai'=>$this->date(),
            'semester'=>$this->string(),
            'topik'=>$this->string(),
            'mhs_id'=>$this->integer(),
            'dosen_id'=>$this->integer(),
            'bukti'=>$this->string(),
            'status_pelaksanaan'=>$this->integer(),
            'status_kegiatan'=>$this->integer(),
            'status_surat'=>$this->integer(),   
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
        ]);

        $this->addForeignKey(
            'fk_mitra_id', 
            'pengajuan_pkl', 'mitra_id', 
            'mitra_pkl', 'id', 
            'CASCADE', 'CASCADE');
        
        $this->addForeignKey(
            'fk_mhs_id', 
            'pengajuan_pkl', 'mhs_id', 
            'mahasiswa', 'mhsid', 
            'CASCADE', 'CASCADE');
        
        $this->addForeignKey(
            'fk_dosen_id', 
            'pengajuan_pkl', 'dosen_id', 
            'dosen', 'id', 
            'CASCADE', 'CASCADE');
    
        $this->addForeignKey(
            'fk_status_pelaksanaan', 
            'pengajuan_pkl', 'status_pelaksanaan', 
            'status_pkl', 'id', 
            'CASCADE', 'CASCADE');
        
        $this->addForeignKey(
            'fk_status_kegiatan', 
            'pengajuan_pkl', 'status_kegiatan', 
            'status_pkl', 'id', 
            'CASCADE', 'CASCADE');

        $this->addForeignKey(
            'fk_status_surat', 
            'pengajuan_pkl', 'status_surat', 
            'status_pkl', 'id', 
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pengajuan_pkl');
    }
}
