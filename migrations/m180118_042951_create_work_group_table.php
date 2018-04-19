<?php

use yii\db\Migration;

/**
 * Handles the creation of table `work_group`.
 */
class m180118_042951_create_work_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('work_group', [
            'id' => $this->primaryKey(),
            'wg_name'=> $this->string(250)->notNull(),
            'wc_id' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('work_group');
    }
}
