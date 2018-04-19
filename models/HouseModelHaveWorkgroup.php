<?php

namespace app\models;

use Yii;
use app\models\HouseModel;

/**
 * This is the model class for table "house_model_have_workgroup".
 *
 * @property int $id
 * @property int $house_model_id
 * @property int $wg_id
 * @property double $cost_control
 */
class HouseModelHaveWorkgroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house_model_have_workgroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_model_id', 'wg_id'], 'required'],
            [['house_model_id', 'wg_id'], 'integer'],
            [['cost_control'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'house_model_id' => 'แบบบ้าน',
            'wg_id' => 'กลุ่มงาน',
            'cost_control' => 'งบควบคุม',
            'houseModel' => 'แบบบ้าน',
            'workGroup' => 'กลุ่มงาน'
        ];
    }

    public function getHouseModel(){
        return $this->hasOne(HouseModel::className(),['id' => 'house_model_id']);
    }

    public function getWorkGroup(){
        return $this->hasOne(WorkGroup::className(),['id' => 'wg_id']);
    }
}
