<?php

use yii\db\Migration;

/**
 * Handles the creation of table `paidtype`.
 */
class m171225_140233_create_paidtype_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('paidtype', [
            'id' => $this->primaryKey(),
            'paid_amount' => $this->float()->notNull(),
            'paid_type' => $this->integer()->notNull(),
            'summoney_id' =>  $this->integer()->notNull(),
            'create_date' => $this->dateTime(),
            'update_date' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('paidtype');
    }
}
