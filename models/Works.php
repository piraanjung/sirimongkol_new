<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "works".
 *
 * @property int $id
 * @property string $work_name
 * @property int $wg_id
 * @property int $work_control_statement
 * @property int $status
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_name', 'wg_id'], 'required'],
            [['wg_id', 'work_control_statement, status'], 'integer'],
            [['work_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_name' => 'ชื่องาน',
            'wg_id' => 'ชื่อกลุ่มงาน',
            'work_control_statement' => 'งบควบคุม',
            'status' =>'สถานะ'
        ];
    }

    public function getWorkGroup(){
        return $this->hasOne(WorkGroup::className(), ['id' => 'wg_id']);
    }

    public function workStatus($status){
        return $status == 0 ? 'ยังไม่เปิดใช้งาน' : 'เปิดใช้งาน'; 
    }
}
