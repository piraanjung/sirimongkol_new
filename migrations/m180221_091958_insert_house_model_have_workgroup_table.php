<?php

use yii\db\Migration;

/**
 * Class m180221_091958_insert_house_model_have_workgroup_table
 */
class m180221_091958_insert_house_model_have_workgroup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // $this->insert('house_model_have_workgroup', [
        //     'house_model_id' => 1,
        //     'wg_id' => 1,
        //     'cost_control' => 800
        // ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180221_091958_insert_house_model_have_workgroup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180221_091958_insert_house_model_have_workgroup_table cannot be reverted.\n";

        return false;
    }
    */
}
