<?php

namespace app\controllers\user;

use Yii;
use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\models\LoginForm;
use dektrium\user\models\User;

class SecurityController extends BaseSecurityController
{
    public function actionLogin()
    {
        \Yii::$app->session->destroy();
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            echo $model['user']['user_type_id'];
            if($model['user']['user_type_id'] == 1){
                //admin
                return $this->redirect(['/user/admin/dashboard']);
            }else if($model['user']['user_type_id'] ==3){
                //employee
                return $this->redirect(['/employee/instalment/index']);
            }else if($model['user']['user_type_id']==2){
                //ceo
                return $this->redirect(['/ceo/ceo/index']);
            }
            // \app\models\Methods::print_array($model['user']);
            // $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            // return $this->goBack();
        }

        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }

    public function actionLogout()
    {
        $event = $this->getUserEvent(\Yii::$app->user->identity);

        $this->trigger(self::EVENT_BEFORE_LOGOUT, $event);

        \Yii::$app->getUser()->logout();

        $this->trigger(self::EVENT_AFTER_LOGOUT, $event);
        \Yii::$app->session->destroy();
        return $this->goHome();
    }
}
