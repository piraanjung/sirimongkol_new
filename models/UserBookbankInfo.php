<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_bookbank_info".
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_id
 * @property string $account_bank
 * @property string $create_date
 * @property string $update_date
 */
class UserBookbankInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_bookbank_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'bank_id', 'account_bank'], 'required'],
            [['user_id', 'bank_id'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['account_bank'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ชื่อผู้ใช้ระบบ',
            'bank_id' => 'ธนาคาร',
            'account_bank' => 'เลขที่บัญชีธนาคาร',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    public function getProfile(){
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getBanks(){
        return $this->hasOne(Banks::className(), ['id' => 'bank_id']);
    }

}
