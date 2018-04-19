<?php

use yii\db\Migration;

/**
 * Class m180123_050504_insert_work_category_table
 */
class m180123_050504_insert_work_category_table extends Migration
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
    //     echo "m180123_050504_insert_work_category_table cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('work_category', [
            'wc_name' => 'งานก่อสร้างบ้าน',
       ]); 
       $this->insert('work_category', [
        'wc_name' => 'รั้วบ้าน / รั้วโครงการ',
       ]);
       $this->insert('work_category', [
            'wc_name' => 'งานเทถนน/ทางเท้า/คันหิน/รางตื้น /ท่อระบายน้ำ / บ่อพักน้ำ',
]);
    }

    public function down()
    {
        $this->dropTable('work_category');
    }
    
}
