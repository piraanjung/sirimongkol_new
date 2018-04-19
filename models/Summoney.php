<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "summoney".
 *
 * @property int $id
 * @property double $total
 * @property int $contructor_id
 * @property int $instalment_id
 * @property string $create_date
 * @property string $update_date
 */
class Summoney extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'summoney';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total', 'contructor_id', 'instalment_id'], 'required'],
            [['total'], 'number'],
            [['contructor_id', 'instalment_id'], 'integer'],
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
            'total' => 'Total',
            'contructor_id' => 'Contructor ID',
            'instalment_id' => 'Instalment ID',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}
