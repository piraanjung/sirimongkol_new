<?php

use yii\db\Migration;

/**
 * Class m180126_050808_add_banks_to_banks_table
 */
class m180126_050808_add_banks_to_banks_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->insert('banks',[
            'name' => 'กรุงไทย',
            'brance' => '-',
            'address' => '-',
            'phone' => '-'
        ]);
        $this->insert('banks',[
            'name' => ' กรุงเทพ',
            'brance' => '-',
            'address' => '-',
            'phone' => '-'
        ]);
        $this->insert('banks',[
            'name' => 'กสิกรไทย',
            'brance' => '-',
            'address' => '-',
            'phone' => '-'
        ]);
        $this->insert('banks',[
            'name' => 'กรุงศรีอยุธยา',
            'brance' => '-',
            'address' => '-',
            'phone' => '-'
        ]);
        $this->insert('banks',[
            'name' => 'ทหารไทย',
            'brance' => '-',
            'address' => '-',
            'phone' => '-'
        ]);
        $this->insert('banks',[
            'name' => 'ไทยพาณิชย์',
            'brance' => '-',
            'address' => '-',
            'phone' => '-'
        ]);
        
        $this->insert('banks',[
            'name' => 'ออมสิน',
            'brance' => '-',
            'address' => '-',
            'phone' => '-'
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('banks');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180126_050808_add_banks_to_banks_table cannot be reverted.\n";

        return false;
    }
    */
}
