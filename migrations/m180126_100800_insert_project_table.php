<?php

use yii\db\Migration;

/**
 * Class m180126_100800_insert_project_table
 */
class m180126_100800_insert_project_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('project', [
            'project_id' => 6,
            'projectname' => 'สิริมงคล 6',
            'control_statement' => 120000000,
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'create_date' =>  date('Y-m-d'),
            'update_date' =>  date('Y-m-d'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('project');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180126_100800_insert_project_table cannot be reverted.\n";

        return false;
    }
    */
}
