<?php

use yii\db\Migration;

/**
 * Handles the creation of table `work_category`.
 */
class m180118_042928_create_work_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('work_category', [
            'id' => $this->primaryKey(),
            'wc_name'=> $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('work_category');
    }
}
