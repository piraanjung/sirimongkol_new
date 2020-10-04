<?php

namespace app\models;

use Yii;
use app\models\Project;
use app\models\HouseModel;
use yii\db\Query;

/**
 * This is the model class for table "houses".
 *
 * @property int $id
 * @property string $house_name
 * @property int $house_model_id
 * @property int $project_id
 * @property int $house_status
 * @property string $create_date
 * @property string $update_date
 */
class Houses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'houses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_name', 'house_model_id', 'project_id'], 'required'],
            [['house_model_id', 'project_id', 'house_status'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['house_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'house_name' => 'แปลงบ้าน',
            'house_model_id' => 'แบบบ้าน',
            'project_id' => 'โครงการ',
            'house_status' => 'สถานะ',
            'create_date' => 'วันที่บันทึกข้อมูล',
            'update_date' => 'วันที่แก้ไขข้อมูล',
            'house_model' => 'แบบบ้าน',
            // 'number_of_workgroup' => 'จำนวนกลุ่มงาน'
        ];
    }

    public function getProject(){
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }

    public function getHouse_model(){
        return $this->hasOne(HouseModel::className(), ['id' => 'house_model_id']);
    }

    public static function countHousesByStatus($status, $project_id){
        $count = Houses::find()
            ->where(['house_status' => $status])
            ->andWhere(['project_id' => $project_id])
            ->all();
            // \app\models\Methods::print_array($count);
        return count($count);
    }

    public static function sumControllStatement(){
        $sum = Houses::find()->sum('control_statement');
        return $sum;
    }

    public static function sumPaidAmountByProject($project_id){
        $query = new Query;
        $query->select('sum(lb.amount) as sumpaid_amount_by_project')
            ->from('houses h')
            ->leftJoin('instalmentcostdetails lb', 'lb.house_id = h.id')
            ->where(['h.project_id' => $project_id]);
        $sumpaid_amount = $query->all();
                    // \app\models\Methods::print_array($sumpaid_amount);

        return $sumpaid_amount[0]['sumpaid_amount_by_project'];
    }
}
