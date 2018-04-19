<?php

use yii\db\Migration;

/**
 * Handles the creation of table `usr_type`.
 */
class m180118_044231_create_usr_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_type', [
            'id' => $this->primaryKey(),
            'user_type_name' => $this->string(250)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_type');
    }
}
