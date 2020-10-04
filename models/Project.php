<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int $project_id
 * @property string $projectname
 * @property double $control_statement
 * @property string $start_date
 * @property string $end_date
 * @property string $create_date
 * @property string $update_date
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'projectname', 'control_statement'], 'required'],
            [['project_id'], 'integer'],
            [['control_statement'], 'number'],
            [['start_date', 'end_date', 'create_date', 'update_date'], 'safe'],
            [['projectname'], 'string', 'max' => 255],
            [['project_id'], 'unique'],
            [['projectname'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'รหัสโครงการ',
            'projectname' => 'ชื่อโครงการ',
            'control_statement' => 'วงเงินควบคุม',
            'start_date' => 'วันเริ่มโครงการ',
            'end_date' => 'วันสิ้นสุดโครงการ',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }


    public function getHouses(){
        return $this->hasMany(House::className(),['project_id' => 'project_id']);
    }

    public function getProjects(){
        return $projects =  (new \yii\db\Query())
                ->select(['project_id', 'projectname'])
                ->from('project')
                ->all();
        // print_r($projects);
        // die();
    }
}
