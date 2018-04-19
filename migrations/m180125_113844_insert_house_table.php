<?php

use yii\db\Migration;

/**
 * Class m180125_113844_insert_house_table
 */
class m180125_113844_insert_house_table extends Migration
{
    // /**
    //  * @inheritdoc
    //  */
    // public function safeUp()
    // {

    // }

    // /**
    //  * @inheritdoc
    //  */
    // public function safeDown()
    // {
    //     echo "m180125_113844_insert_house_table cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        for($i=1; $i<=100; $i++){
            $this->insert('houses',[
                'house_name' => $i."A",
                'house_model_id' => rand(1,2),
                'project_id' => 6,
                'house_status' => 0,
                'create_date' => date('Y-m-d'),
                'update_date' => date('Y-m-d'),
    
            ]);
        }
        
    }

    public function down()
    {
        $this->dropTable('houses');
    }

}
