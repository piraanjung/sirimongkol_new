<?php

use yii\db\Migration;

/**
 * Class m180123_082008_add_work_id_to_instalmentdetails_table
 */
class m180123_082008_add_work_id_to_instalmentdetails_table extends Migration
{
    /**
     * @inheritdoc
     */
    // public function safeUp()
    // {

    // }

    // /**
    //  * @inheritdoc
    //  */
    // public function safeDown()
    // {
    //     echo "m180123_082008_add_work_id_to_instalmentdetails_table cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('instalmentcostdetails', 'work_id', 
                            $this->integer()->after('worktype_id'));
    }

    public function down()
    {
        $this->dropColumn('instalmentcostdetails', 'work_id');
    }
    
}
