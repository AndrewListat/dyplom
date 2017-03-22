<?php

namespace app\modules\ls_admin\controllers;

use app\modules\ls_admin\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\ls_admin\models\LoginForm;
use app\modules\ls_admin\models\RegForm;

class DefaultController extends Controller
{
    public $layout = 'admin';
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect('people/index');
        }else {
            return $this->redirect(['/app/signin']);
        }
    }
    public function actionSignin()
    {
        $error=false;
        $this->layout = 'main';
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/app/index']);
        }

        $model = new LoginForm();

        if (Yii::$app->request->post()){

            $model->email = Yii::$app->request->post('email');
            $model->password = Yii::$app->request->post('password');
            $model->rememberMe = Yii::$app->request->post('rememberMe');
            if ($model->login()) {

                return $this->redirect(['/app/index']);
            }
            if ($model->validate()){
                $error=false;
            }else {
                $error =$model->errors;
            }
        }
        return $this->render('log', [
            'model' => $model,
            'masseg' => $error,
        ]);
    }


    public function actionSignup()
    {
        $this->layout = 'main';
        $error = false;

        $model = new RegForm();
        if (Yii::$app->request->post()) {
            $model->username = Yii::$app->request->post('username');
            $model->lastname = Yii::$app->request->post('lastname');
            $model->password = Yii::$app->request->post('password');
            $model->login = 'user';
            $model->email = Yii::$app->request->post('email');
            if ( $model->validate()):
                if ($user = $model->reg()):
                    if ($user->status === User::STATUS_ACTIVE):
                        if (Yii::$app->getUser()->login($user)):
                            return $this->redirect(['/app/index']);
                        endif;
                    endif;
                endif;
            endif;
            if ($model->validate()) {
                $error = false;
            } else {
                $error = $model->errors;
            }
        }
        return $this->render(
            'reg',
            [
                'model' => $model,
                'masseg' => $error,
            ]
        );
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/app/signin']);
    }

    public function actionDel()
    {


    }
}
