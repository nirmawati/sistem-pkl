<?php

use yii\db\Migration;

/**
 * Handles the creation of table `kategori_industri`.
 */
class m190124_113746_create_kategori_industri_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kategori_industri', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(),
            'prodi_id' => $this->integer(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
        ]);

        $this->addForeignKey(
            'fk_prodi_id', 
            'kategori_industri', 'prodi_id', 
            'prodi', 'id', 
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('kategori_industri');
    }
}
