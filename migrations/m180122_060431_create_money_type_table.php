<?php

use yii\db\Migration;

/**
 * Handles the creation of table `money_type`.
 */
class m180122_060431_create_money_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('money_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        
        $this->insert('money_type', [
            'name' => "ระหว่างงวด",
        ]);
        $this->insert('money_type', [
            'name' => "จบงวด",
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('money_type');
    }
}
