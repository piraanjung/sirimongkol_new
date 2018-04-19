<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house_model`.
 */
class m180118_054837_create_house_model_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('house_model', [
            'id' => $this->primaryKey(),
            'hm_code' => $this->string(10)->notNull()->unique(),
            'hm_name' => $this->string(100)->notNull(),
            'hm_control_statment' => $this->float()->notNull(),
            'hm_description' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('house_model');
    }
}
