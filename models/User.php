<?php
namespace app\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][]   = 'user_type_id';
        $scenarios['update'][]   = 'user_type_id';
        $scenarios['register'][] = 'user_type_id';

        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        $rules['user_type_idRequired'] = ['user_type_id', 'required'];
        $rules['user_type_idLength']   = ['user_type_id', 'integer'];

        return $rules;
    }

}

?>