<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m180118_051308_create_project_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull()->unique(),
            'projectname' => $this->string(180)->notNull()->unique(),
            'control_statement' => $this->float()->notNull(),
            'start_date' => $this->date(),
            'end_date'  => $this->date(),
            'create_date' => $this->date(),
            'update_date' => $this->date(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('project');
    }
}
