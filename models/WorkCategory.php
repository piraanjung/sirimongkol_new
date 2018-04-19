<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_category".
 *
 * @property int $id
 * @property string $wc_name
 */
class WorkCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wc_name'], 'required'],
            [['wc_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wc_name' => 'ชื่อกลุ่มงาน',
        ];
    }
}
