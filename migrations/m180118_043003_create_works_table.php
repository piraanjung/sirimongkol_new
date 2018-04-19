<?php

use yii\db\Migration;

/**
 * Handles the creation of table `works`.
 */
class m180118_043003_create_works_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('works', [
            'id' => $this->primaryKey(),
            'work_name' => $this->string()->notNull(),
            'wg_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('works');
    }
}
