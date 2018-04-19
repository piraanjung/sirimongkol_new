<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banks".
 *
 * @property int $id
 * @property string $name
 * @property string $brance
 * @property string $address
 * @property string $phone
 */
class Banks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'brance', 'address', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อธนาคาร',
            'brance' => 'สาขา',
            'address' => 'ที่อยู่',
            'phone' => 'เบอร์โทร',
        ];
    }
}
