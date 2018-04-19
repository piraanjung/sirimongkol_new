<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_bookbank_info`.
 */
class m180103_140541_create_user_bookbank_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_bookbank_info', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'bank_id' =>  $this->integer()->notNull(),
            'account_bank' =>  $this->string()->notNull(),
            'create_date' => $this->dateTime(),
            'update_date' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_bookbank_info');
    }
}
