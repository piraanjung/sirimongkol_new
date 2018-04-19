<?php

use yii\db\Migration;

/**
 * Class m180224_014843_insert_to_house_model_have_workgroup_table
 */
class m180224_014843_insert_to_house_model_have_workgroup_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    { //house_model_id wg_id cost_control
        //กลุ่มงานสำหรับแบบบ้าน conceptและconfort
      
        $complete =array(
                    ['เตรียมงาน',1,800], 
                    ['เสาเข็ม',2,11550],
                    ['หลังคา',3, 56468], 
                    ['ปลวก',4, 4000], 
                    ['โครงสร้าง',5, 85000],
                    ['ก่อ-ฉาบ',6, 108000],
                    ['บัวและรางระบายน้ำ(ตัวบ้าน)',7, 6500], 
                    ['ฝ้า-เพดาน',8, 53000],
                    ['กระเบื้อง / หินแกรนิต',9, 29875], 
                    ['สี',10, 23500],
                    ['งานอลูมิเนียม',12, 129500], 
                    ['ประตูไม้เทียม',13, 4970],
                    ['ตกแต่งบันได',17, 11200], 
                    ['laminate Vinyl บัว',19, 37995],
                    ['ประปา / สุขาภิบาล',14, 89668.25], 
                    ['ไฟฟ้า / สื่อสาร',15, 92400],
                    ['เครื่องใช้ไฟฟ้า',31, 17000], 
                    ['พื้นคอนกรีตรอบบ้าน',16, 6000],
                    ['สวนรอบบ้าน',18, 1400], 
                    ['งานเทถนน/ทางเท้า/คันหิน/รางตื้น',25, 0],
                    ['มิเตอร์', 20, 8956.50]
                ); 
        $concept_and_comfort =array(
                    ['เตรียมงาน',1,800], 
                    ['เสาเข็ม',2,12480],
                    ['หลังคา',3, 3800],                    
                    ['ปลวก',4, 4000], 
                    ['โครงสร้าง',5, 111500],
                    ['ก่อ-ฉาบ',6, 141500],
                    ['บัวและรางระบายน้ำ(ตัวบ้าน)',7, 7500], 
                    ['ฝ้า-เพดาน',8, 63000],
                    ['กระเบื้อง / หินแกรนิต',9, 28570], 
                    ['สี',10, 29200],
                    ['งานอลูมิเนียม',12, 149600], 
                    ['ประตูไม้เทียม',13, 5640],
                    ['ตกแต่งบันได',17, 11200], 
                    ['laminate Vinyl บัว',19, 132950],
                    ['ประปา / สุขาภิบาล',14, 93311.25], 
                    ['ไฟฟ้า / สื่อสาร',15, 102,400],
                    ['เครื่องใช้ไฟฟ้า',31, 17000], 
                    ['พื้นคอนกรีตรอบบ้าน',16, 5800],
                    ['สวนรอบบ้าน',18, 0], 
                    ['งานเทถนน/ทางเท้า/คันหิน/รางตื้น',25, 0],
                    ['มิเตอร์', 20, 0]
                );   

        foreach($concept_and_comfort as $cp){
            $this->insert('house_model_have_workgroup',[
                'house_model_id' => 1, 
                'wg_id'  => $cp[1],
                'cost_control' => $cp[2]
            ]);
        }
        foreach($concept_and_comfort as $cp){
            $this->insert('house_model_have_workgroup',[
                'house_model_id' => 2, 
                'wg_id'  => $cp[1],
                'cost_control' => $cp[2]
            ]);
        }
        foreach($complete as $cp){
            $this->insert('house_model_have_workgroup',[
                'house_model_id' => 3, 
                'wg_id'  => $cp[1],
                'cost_control' => $cp[2]
            ]);
        }

        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180224_014843_insert_to_house_model_have_workgroup_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180224_014843_insert_to_house_model_have_workgroup_table cannot be reverted.\n";

        return false;
    }
    */
}
