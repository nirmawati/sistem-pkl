<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mitra_pkl`.
 */
class m190124_115339_create_mitra_pkl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // * @property string $nama
        // * @property string $alamat
        // * @property string $kontak
        // * @property string $telpon
        // * @property string $email
        // * @property int $status
        // * @property int $kategori_id
        $this->createTable('mitra_pkl', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(),
            'alamat'=> $this->string(),
            'kontak'=>$this->string(),
            'telpon'=>$this->string(),
            'email'=>$this->string()->unique(),
            'status'=>$this->integer(),
            'kategori_id' => $this->integer(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
        ]);

        $this->addForeignKey(
            'fk_kategori_id', 
            'mitra_pkl', 'kategori_id', 
            'kategori_industri', 'id', 
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('mitra_pkl');
    }
}
