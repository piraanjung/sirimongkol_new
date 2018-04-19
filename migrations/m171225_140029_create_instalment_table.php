<?php

use yii\db\Migration;

/**
 * Handles the creation of table `instalment`.
 */
class m171225_140029_create_instalment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('instalment', [
            'id' => $this->primaryKey(),
            'instalment' => $this->string()->notNull(),
            'monthly' => $this->string()->notNull(),
            'year' => $this->string()->notNull(),
            'project_id' => $this->string()->notNull(),
            'editor_id' => $this->string()->notNull(),
            'create_date' => $this->dateTime(),
            'update_date' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('instalment');
    }
}
