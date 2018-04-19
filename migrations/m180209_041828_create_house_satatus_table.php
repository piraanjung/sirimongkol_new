<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house_satatus`.
 */
class m180209_041828_create_house_satatus_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('house_satatus', [
            'id' => $this->primaryKey(),
            'house_status' => $this->string(),
        ]);

        $this->insert('house_satatus',[
            'house_status' =>'ยังไม่ก่อสร้าง',
        ]);
        $this->insert('house_satatus',[
            'house_status' =>'กำลังก่อสร้าง',
        ]);
        $this->insert('house_satatus',[
            'house_status' =>'สร้างแล้วเสร็จ',
        ]);
        $this->insert('house_satatus',[
            'house_status' =>'ปกติ',
        ]);
        $this->insert('house_satatus',[
            'house_status' =>'เกินงบควบคุม',
        ]);
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('house_satatus');
    }
}
