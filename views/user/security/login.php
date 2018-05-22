<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'เข้าสู่ระบบ');
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

        <div class="row" style="margin-top:10%">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">store</i>
                    </div>
                    <div class="card-content">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?= Html::encode($this->title) ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => false,
                            'validateOnBlur' => false,
                            'validateOnType' => false,
                            'validateOnChange' => false,
                        ]) ?>

                        <?php if ($module->debug): ?>
                        <?= $form->field($model, 'login', [
                            'inputOptions' => [
                                'autofocus' => 'autofocus',
                                'class' => 'form-control',
                                'tabindex' => '1']])->dropDownList(LoginForm::loginList())
                                ->label(Yii::t('user', $this->title));
                        ?>

                            <?php else: ?>

                            <?= $form->field($model, 'login',
                                ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                            ) ->label(Yii::t('user', $this->title));
                            ?>

                                <?php endif ?>

                                <?php if ($module->debug): ?>
                                <div class="alert alert-warning">
                                    <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
                                </div>
                                <?php else: ?>
                                <?= $form->field(
                                    $model,
                                    'password',
                                    ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                                    ->passwordInput()
                                    ->label(
                                        Yii::t('user', 'รหัสผ่าน')
                                        . ($module->enablePasswordRecovery ?
                                            ' (' . Html::a(
                                                Yii::t('user', 'ลืมรหัสผ่าน?'),
                                                ['/user/recovery/request'],
                                                ['tabindex' => '5']
                                            )
                                            . ')' : '')
                                    ) ?>
                                    <?php endif ?>

                                    <!-- < $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?> -->

                                        <?= Html::submitButton(
                                            Yii::t('user', 'เข้าสู่ระบบ'),
                                            ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
                                        ) ?>

                                            <?php ActiveForm::end(); ?>
                    </div>
                </div>

                    </div>
                    <div class="card-footer">
                        <!-- <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                        </div> -->
                    </div>
                </div>
              
            </div>
        </div>