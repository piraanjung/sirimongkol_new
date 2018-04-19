<?php

use yii\db\Migration;

/**
 * Handles the creation of table `summoney`.
 */
class m171225_140214_create_summoney_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('summoney', [
            'id' => $this->primaryKey(),
            'total' => $this->float()->notNull(),
            'contructor_id' => $this->integer()->notNull(),
            'instalment_id'=>$this->integer()->notNull(),
            'create_date' => $this->dateTime(),
            'update_date' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('summoney');
    }
}
