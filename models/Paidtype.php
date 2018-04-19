<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paidtype".
 *
 * @property int $id
 * @property double $paid_amount
 * @property int $paid_type
 * @property int $summoney_id
 * @property string $create_date
 * @property string $update_date
 */
class Paidtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paidtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paid_amount', 'paid_type', 'summoney_id'], 'required'],
            [['paid_amount'], 'number'],
            [['paid_type', 'summoney_id'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paid_amount' => 'Paid Amount',
            'paid_type' => 'Paid Type',
            'summoney_id' => 'Summoney ID',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}
