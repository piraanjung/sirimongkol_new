<?php

use yii\db\Migration;

/**
 * Class m180212_025138_insert_demo_instalment_and_instalmentcostdetail_table
 */
class m180212_025138_insert_demo_instalment_and_instalmentcostdetail_table extends Migration
{
    /**
     * @inheritdoc
     */
    

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        for($i=1; $i<=12; $i++ ){
            for($j=1; $j<=2; $j++){
                $day =$j==1 ? 1: 16;
                $this->insert('instalment',[
                    'instalment' => $j,
                    'monthly' => $i, 
                    'year' => 60, 
                    'project_id' => 6, 
                    'editor_id' =>4,
                    'create_date' => date('2017-'.$i.'-'.$day.' H:i:s'),
                    'update_date' => date('2017-'.$i.'-'.$day.' H:i:s'),
                ]);
            }
        }
        

    
        for($i=1; $i<=1000; $i++){
            $rand_arr = ['0','00','000','500','250','120','800','450','320','500'];
            $a =array_rand($rand_arr,1);
            $this->insert('instalmentcostdetails', [
                'instalment_id' => rand(1,24),
                'contructor_id' =>rand(3,10),
                'house_id' =>rand(1,100),
                'workclassify_id' =>rand(1,3),
                'worktype_id' =>rand(1,25),
                'work_id' =>rand(1,129),
                'money_type_id' =>rand(1,2),
                'amount' => rand(1,20).$rand_arr[$a],
                'summoney_id' =>0,
                'saver_id' =>2,
                'comment' =>'',
                'create_date' => date('2017-'.rand(1,12).'-'.array_rand([1,30],1).' H:i:s'),
                'update_date' => date('2017-'.rand(1,12).'-'.array_rand([1,30],1).' H:i:s'),
            ]);
        }
        
    }

    public function down()
    {
        echo "m180212_025138_insert_demo_instalment_and_instalmentcostdetail_table cannot be reverted.\n";

        return false;
    }
    
}
