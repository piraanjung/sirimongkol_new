<?php

namespace app\controllers\user;

use Yii;
use yii\helpers\Url;
use dektrium\user\models\User;
use dektrium\user\models\UserSearch;
use dektrium\user\helpers\Password;
use dektrium\user\controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function actionIndex()
    {
        $this->layout = 'admin';
        Url::remember('', 'actions-redirect');
        $searchModel  = \Yii::createObject(UserSearch::className());
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    } 
    public function actionDashboard(){
        $this->layout = 'admin';
        return $this->render('/admin/dashboard');
    }

    public function actionCreate()
    {
        $this->layout = 'admin';
        $user = \Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'create',
        ]);
        $event = $this->getUserEvent($user);

        $this->performAjaxValidation($user);

        $this->trigger(self::EVENT_BEFORE_CREATE, $event);
        // \app\models\Methods::print_array($_REQUEST);
        if ($user->load(\Yii::$app->request->post())) {
            $user->username = $_REQUEST['User']['username'];
            $user->password_hash = Password::hash($_REQUEST['User']['password']);
            $user->email = $_REQUEST['User']['email'];
            $user->auth_key = '1234';
            $user->created_at = strtotime(date('Y m d'));
            $user->updated_at = strtotime(date('Y m d'));
            $user->user_type_id = $_REQUEST['User']['user_type_id'];
            if($user->save()){
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been created'));
                $this->trigger(self::EVENT_AFTER_CREATE, $event);
                return $this->redirect(['update', 'id' => $user->id]);
            }else{
                \Yii::$app->getSession()->setFlash('warning', \Yii::t('user', 'User has not been created'));
                $this->trigger(self::EVENT_AFTER_CREATE, $event);
            }

            
            
        }
        // \app\models\Methods::print_array($_REQUEST);
        return $this->render('create', [
            'user' => $user,
        ]);
    }

    public function actionUpdate($id)
    {
        $this->layout = 'admin';
        Url::remember('', 'actions-redirect');
        $user = $this->findModel($id);
        $user->scenario = 'update';
        $event = $this->getUserEvent($user);

        $this->performAjaxValidation($user);

        $this->trigger(self::EVENT_BEFORE_UPDATE, $event);
        if ($user->load(\Yii::$app->request->post()) && $user->save()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Account details have been updated'));
            $this->trigger(self::EVENT_AFTER_UPDATE, $event);
            return $this->refresh();
        }

        return $this->render('_account', [
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing profile.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdateProfile($id)
    {
        $this->layout = 'admin';
        Url::remember('', 'actions-redirect');
        $user    = $this->findModel($id);
        $profile = $user->profile;

        if ($profile == null) {
            $profile = \Yii::createObject(Profile::className());
            $profile->link('user', $user);
        }
        $event = $this->getProfileEvent($profile);

        $this->performAjaxValidation($profile);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);
        // \app\models\Methods::print_array($_REQUEST);
        if ($profile->load(\Yii::$app->request->post()) && $profile->save()) {
            $profile->phone = $_REQUEST['Profile']['phone'];
            $profile->save();
            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Profile details have been updated'));
            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);
            return $this->refresh();
        }

        return $this->render('_profile', [
            'user'    => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Shows information about user.
     *
     * @param int $id
     *
     * @return string
     */
    public function actionInfo($id)
    {
        $this->layout = 'admin';
        Url::remember('', 'actions-redirect');
        $user = $this->findModel($id);

        return $this->render('_info', [
            'user' => $user,
        ]);
    }
}
