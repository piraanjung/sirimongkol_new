<?php

use yii\db\Migration;

/**
 * Handles the creation of table `houses`.
 */
class m180118_053225_create_houses_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('houses', [
            'id' => $this->primaryKey(),
            'house_name' => $this->string()->notNull(),
            'house_model_id' => $this->integer()->notNull(),
            'project_id' => $this->integer(11)->notNull(),
            'house_status' => $this->integer(2),
            'create_date' => $this->date(),
            'update_date' => $this->date()
        ]);
        
    }




    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('houses');
    }
}
