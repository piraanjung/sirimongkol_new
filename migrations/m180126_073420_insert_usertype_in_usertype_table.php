<?php

use yii\db\Migration;

/**
 * Class m180126_073420_insert_usertype_in_usertype_table
 */
class m180126_073420_insert_usertype_in_usertype_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('user_type',[
            'user_type_name' => 'ผู้ดูแลระบบ',
        ]);
        $this->insert('user_type',[
            'user_type_name' => 'ประธานกรรมการ',
        ]);
        $this->insert('user_type',[
            'user_type_name' => 'ผนักงาน',
        ]);
        $this->insert('user_type',[
            'user_type_name' => 'ช่าง/ผู้รับเหมา',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180126_073420_insert_usertype_in_usertype_table cannot be reverted.\n";

        return false;
    }
    */
}
