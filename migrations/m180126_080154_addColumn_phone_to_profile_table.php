<?php

use yii\db\Migration;

/**
 * Class m180126_080154_addColumn_phone_to_profile_table
 */
class m180126_080154_addColumn_phone_to_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('profile', 'phone',$this->string()->after('name'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('profile', 'phone');
    }

    
}
