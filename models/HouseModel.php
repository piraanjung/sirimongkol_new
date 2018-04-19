<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house_model".
 *
 * @property int $id
 * @property string $hm_code
 * @property string $hm_name
 * @property double $hm_control_statment
 * @property string $hm_description
 */
class HouseModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hm_code', 'hm_name', 'hm_control_statment'], 'required'],
            [['hm_control_statment'], 'number'],
            [['hm_description'], 'string'],
            [['hm_code'], 'string', 'max' => 10],
            [['hm_name'], 'string', 'max' => 100],
            [['hm_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hm_code' => 'รหัสแบบบ้าน',
            'hm_name' => 'ชื่อแบบบ้าน',
            'hm_control_statment' => 'งบควบคุมแบบบ้าน',
            'hm_description' => 'คำอธิบาย',
        ];
    }
}
