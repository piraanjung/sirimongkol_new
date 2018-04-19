<?php

use yii\db\Migration;
use dektrium\user\helpers\Password;

/**
 * Class m180122_162249_insert_user_tabel
 */
class m180122_162249_insert_user_tabel extends Migration
{

    public function up()
    {
        $this->insert('user', [
            'username'          => 'admin',
            'email'             => 'admin@gmail.com',
            'password_hash'     => Password::hash('123456'), 
            'auth_key'          => 1234, 
            'confirmed_at'      => 0, 
            'unconfirmed_email' => 'admin@gmail.com',
            'blocked_at'        => 0, 
            'registration_ip'   => 'admin@gmail.com',
            'created_at'        => strtotime("now"), 
            'updated_at'        => strtotime("now"), 
            'flags'             => 1, 
            'last_login_at'     => 0,
            'user_type_id'      => 1
       ]);
       
        $this->insert('user', [
            'username'          => 'ceo',
            'email'             => 'ceo@gmail.com',
            'password_hash'     => Password::hash('123456'), 
            'auth_key'          => 1234, 
            'confirmed_at'      => 0, 
            'unconfirmed_email' => 'ceo@gmail.com',
            'blocked_at'        => 0, 
            'registration_ip'   => 'ceo@gmail.com',
            'created_at'        => strtotime("now"), 
            'updated_at'        => strtotime("now"), 
            'flags'             => 1, 
            'last_login_at'     => 0,
            'user_type_id'      => 2
        ]);  

        $this->insert('user', [
            'username'          => 'user1',
            'email'             => 'user1@gmail.com',
            'password_hash'     => Password::hash('123456'), 
            'auth_key'          => 1234, 
            'confirmed_at'      => 0, 
            'unconfirmed_email' => 'user1@gmail.com',
            'blocked_at'        => 0, 
            'registration_ip'   => 'user1@gmail.com',
            'created_at'        => strtotime("now"), 
            'updated_at'        => strtotime("now"), 
            'flags'             => 1, 
            'last_login_at'     => 0,
            'user_type_id'      => 3
        ]); 

        for($i=1; $i<=12; $i++){
            $this->insert('user', [
                'username'          => 'const'.$i,
                'email'             => 'const'.$i.'@gmail.com',
                'password_hash'     => Password::hash('123456'), 
                'auth_key'          => 1234, 
                'confirmed_at'      => 0, 
                'unconfirmed_email' =>'const'.$i.'@gmail.com',
                'blocked_at'        => 0, 
                'registration_ip'   =>'const'.$i.'@gmail.com',
                'created_at'        => strtotime("now"), 
                'updated_at'        => strtotime("now"), 
                'flags'             => 1, 
                'last_login_at'     => 0,
                'user_type_id'      => 4
            ]); 
        }
        $name = [
            1=>  'นายสายันต์  นามลีลา',
            2 => 'นายชลิต  อามัสสา',	 	
            3 => 'นายประดิษฐ์  ประสงค์ดี',	 	
            4 => 'นาคำผ่าน  ขันคำ',	 
            5 => 'นางสาวสุพัตรา  ขจรวงศ์',
            6 => 'นายสมยศ  พันพงศ์แข็ง',	 	
            7 => 'นายอุทัย  บุญอุด',	 	
            8 => 'นางบานเย็น จันทร์แจ้ง',
            9 => 'นายวิรัตน์  แก่นนาคำ',
            10 =>'นายรุ่งนิรันดร์  นนท์ศิริ',	 	
            11 =>'นางสาวลัดดาวัลย์  อดทน',
            12 => 'นายชาติชาย  สัมพันธ์เพ็ง'	 	
        ];
        for($i=4; $i<=15; $i++){
            $a =$i-3;
            $this->insert('profile', [
                'user_id' => $i,
                'name' => $name[$a],
                'public_email' => '',
                'gravatar_email' => '',
                'gravatar_id' => '',
                'location' => '',
                'bio' => '',
                'timezone' => '',
            ]); 
        }
         
    }

    public function down()
    {
        echo "m180122_162249_insert_user_tabel cannot be reverted.\n";

        $this->dropTable('user');
    }
    
}
