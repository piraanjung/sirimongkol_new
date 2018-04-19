<?php

use yii\db\Migration;

/**
 * Handles the creation of table `instalmentcostdetails`.
 */
class m171225_140146_create_instalmentcostdetails_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('instalmentcostdetails', [
            'id' => $this->primaryKey(),
            'instalment_id'=> $this->integer()->notNull(),
            'contructor_id' => $this->integer()->notNull(),
            'house_id' => $this->integer()->notNull(),
            'workclassify_id' => $this->integer()->notNull(),
            'worktype_id' => $this->integer()->notNull(),
            'money_type_id' =>$this->integer()->notNull(),
            'amount' => $this->float()->notNull(),
            'summoney_id' => $this->integer()->notNull(),
            'saver_id' =>$this->integer()->notNull(),
            'create_date' => $this->dateTime(),
            'update_date' => $this->dateTime()

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('instalmentcostdetails');
    }
}
