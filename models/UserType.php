<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property int $id
 * @property string $user_type_name
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_name'], 'required'],
            [['user_type_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type_name' => 'User Type Name',
        ];
    }
}
