<?php

namespace app\models;

use Yii;
// use app\models\Instalment;
/**
 * This is the model class for table "instalmentcostdetails".
 *
 * @property integer $id
 * @property integer $instalment_id
 * @property integer $contructor_id
 * @property integer $house_id
 * @property integer $workclassify_id
 * @property integer $worktype_id
 * @property integer $money_type_id
 * @property double $amount
 * @property integer $summoney_id
 * @property integer $saver_id
 * @property string $comment
 * @property string $create_date
 * @property string $update_date
 */
class Instalmentcostdetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instalmentcostdetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['instalment_id', 'contructor_id', 'house_id', 'workclassify_id', 'worktype_id', 'money_type_id', 'amount', 'summoney_id', 'saver_id'], 'required'],
            [['instalment_id', 'contructor_id', 'house_id', 'workclassify_id', 'worktype_id', 'work_id',  'money_type_id', 'summoney_id', 'saver_id'], 'integer'],
            [['comment'], 'string'],
            [['amount'], 'number'],
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
            'instalment_id' => 'Instalment ID',
            'contructor_id' => 'Contructor ID',
            'house_id' => 'House ID',
            'workclassify_id' => 'Workclassify ID',
            'worktype_id' => 'รายละเอียดงาน',
            'work_id' => 'งาน',
            'money_type_id' => 'ชนิดเงิน',
            'amount' => 'จำนวนเงิน',
            'summoney_id' => 'Summoney ID',
            'saver_id' => 'Saver ID',
            'comment' => 'หมายเหตุ',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'houses' => 'แปลงบ้าน',
            'constructor' => 'ชื่อช่าง',
            'workGroup' => 'กลุ่มงาน',
            'work' => 'งาน',
            'workControlStatement' => 'งบควบคุม'
        ];
    }
    public function getInstalment(){
        return $this->hasOne(Instalment::className(),['instalment_id' => 'id']);
    }

    public function getWorkGroup(){
        return $this->hasOne(WorkGroup::className(),['id'=> 'worktype_id']);
    }

    public function getWorkOne(){
        return $this->hasOne(Works::className(),['id'=> 'work_id']);
    }

    public function getWork(){
        return $this->hasOne(Works::className(),['wg_id'=> 'worktype_id']);
    }

    public function getHouses(){
        return $this->hasOne(Houses::className(), ['id' => 'house_id']);
    }

    public function getConstructor(){
        return $this->hasOne(Profile::className(), ['user_id' => 'contructor_id']);
    }

    public function getMoneyType(){
        return $this->hasOne(MoneyType::className(), ['id' => 'money_type_id']);
    }    

}
