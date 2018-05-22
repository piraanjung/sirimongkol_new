<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "instalment".
 *
 * @property integer $id
 * @property string $instalment
 * @property integer $monthly
 * @property integer $year
 * @property string $project_id
 * @property string $editor_id
 * @property string $create_date
 * @property string $update_date
 */
class Instalment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instalment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['instalment', 'monthly', 'year', 'project_id', 'editor_id'], 'required'],
            [['monthly', 'year'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['instalment', 'project_id', 'editor_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'instalment' => 'งวดที่จ่าย',
            'monthly' => 'ประจำเดือน',
            'year' => 'ปี',
            'project_id' => 'โครงการ',
            'editor_id' => 'ผู้บันทึกข้อมูล',
            'create_date' => 'วันที่บันทึก',
            'update_date' => 'วันที่แก้ไข',
            'profile' => 'ผู้บันทึก',
            'project' => 'ชื่อโครงการ'
        ];
    }

    public function date_of_instalment($date){
        $d_arr  = explode(" ", $date);
        $_d_arr = explode("-", $d_arr[0]);
        $_year  = $_d_arr[0]+543;
        $_month = $_d_arr[1];
        $_day   = $_d_arr[2];
        $moth_str = \app\models\Methods::getMonth($_month);
        echo $_day." ".$moth_str." ".$_year;
    }

    public function getProfile(){
        return $this->hasOne(Profile::className(),['user_id' => 'editor_id']);
    }

    public function getProject(){
        return $this->hasOne(Project::className(),['project_id' => 'project_id']);
    }


}
