<?php

use yii\db\Migration;

/**
 * Handles the creation of table `semester`.
 */
class m190311_051026_create_semester_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('semester', [
            'id' => $this->primaryKey(),
            'nama' =>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('semester');
    }
}
