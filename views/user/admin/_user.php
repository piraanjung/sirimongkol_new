<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\User $user
 */
$userType = \app\models\UserType::find()->all();
$userTypeList = \yii\helpers\ArrayHelper::map($userType, 'id','user_type_name');
?>

<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
<?= $form->field($user, 'user_type_id')->dropDownList($userTypeList,[
        'prompt' => 'เลือกประเภทผู้ใช้ระบบ...'
    ])->label('ประเภทผู้ใช้ระบบ');
?>
