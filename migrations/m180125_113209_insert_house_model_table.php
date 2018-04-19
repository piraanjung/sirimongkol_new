<?php

use yii\db\Migration;

/**
 * Class m180125_113209_insert_house_model_table
 */
class m180125_113209_insert_house_model_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('house_model', [
            'hm_code' => 'CC01',
            'hm_name'   => 'Concept',
            'hm_control_statment' => 800000,
            'hm_description' => 'บ้านเดี่ยวหนึงชั้น สองห้องนอน สองห้องน้ำ'
        ]);
        $this->insert('house_model', [
            'hm_code' => 'CF01',
            'hm_name'   => 'Comfort',
            'hm_control_statment' => 1200000,
            'hm_description' => 'บ้านเดี่ยวสองชั้น สองห้องนอน สามห้องน้ำ'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('house_model');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180125_113209_insert_house_model_table cannot be reverted.\n";

        return false;
    }
    */
}
