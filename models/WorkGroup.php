<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_group".
 *
 * @property int $id
 * @property string $wg_name
 * @property int $wc_id
 * @property int $wg_status
 */
class WorkGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wg_name'], 'required'],
            [['wc_id','wg_status'], 'integer'],
            [['wg_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wg_name' => 'ชื่อกลุ่มงาน',
            'wc_id' => 'ชื่อหมวดงาน',
            'wg_status' => 'สถานเปิดใช้งาน'
        ];
    }

    public function getWorkCategory(){
        return $this->hasOne(WorkCategory::className(), ['id' => 'wc_id']);
    }

    public function workGroupStatus($status){
        return $status == 0 ? 'ยังไม่เปิดใช้งาน' : 'เปิดใช้งาน'; 
    }
}
