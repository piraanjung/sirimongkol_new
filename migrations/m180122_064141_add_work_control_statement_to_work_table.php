<?php

use yii\db\Migration;

/**
 * Class m180122_064141_add_work_control_statement_to_work_table
 */
class m180122_064141_add_work_control_statement_to_work_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('works', 'work_control_statement', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m180122_064141_add_work_control_statement_to_work_table cannot be reverted.\n";

        $this->dropTable('works');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180122_064141_add_work_control_statement_to_work_table cannot be reverted.\n";

        return false;
    }
    */
}
