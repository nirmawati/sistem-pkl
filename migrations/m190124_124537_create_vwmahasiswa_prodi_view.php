<?php

use yii\db\Migration;

/**
 * Class m190124_124537_create_vwmahasiswa_prodi_view
 */
class m190124_124537_create_vwmahasiswa_prodi_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //$this->createView('vwmahasiswa_prodi', ' select  a.mhsid, a.user_id, a.nim, a.thn_masuk, b.nama, c.nama as prodi from mahasiswa a inner join camaba b on a.camaba_id = b.id inner join prodi c on a.prodi_id = c.id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190124_124537_create_vwmahasiswa_prodi_view cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190124_124537_create_vwmahasiswa_prodi_view cannot be reverted.\n";

        return false;
    }
    */
}
