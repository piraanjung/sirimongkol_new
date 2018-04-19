<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house_model_have_workgroup`.
 */
class m180221_091416_create_house_model_have_workgroup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('house_model_have_workgroup', [
            'id' => $this->primaryKey(),
            'house_model_id' => $this->integer()->notNull(),
            'wg_id' => $this->integer()->notNull(),
            'cost_control' => $this->float()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('house_model_have_workgroup');
    }
}
