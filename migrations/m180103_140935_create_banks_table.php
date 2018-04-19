<?php

use yii\db\Migration;

/**
 * Handles the creation of table `banks`.
 */
class m180103_140935_create_banks_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('banks', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'brance' => $this->string(),
            'address' => $this->string(),
            'phone' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('banks');
    }
}
