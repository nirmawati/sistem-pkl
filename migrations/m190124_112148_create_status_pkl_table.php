<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status_pkl`.
 */
class m190124_112148_create_status_pkl_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('status_pkl', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('status_pkl');
    }
}
