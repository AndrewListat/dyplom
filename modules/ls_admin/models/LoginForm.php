<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 29.11.2015
 * Time: 12:10
 */
namespace app\modules\ls_admin\models;
use yii\base\Model;
use Yii;
class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;
    public $status;
    private $_user = false;
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()):
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)):
                $this->addError($attribute, 'Неправильный email или пароль.');
            endif;
        endif;
    }
    public function getUser()
    {
        if ($this->_user === false):

                $this->_user = User::findByEmail($this->email);

        endif;
        return $this->_user;
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Ник',
            'email' => 'Емайл',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }
    public function login()
    {
        if ($this->validate()):
            $this->status = ($user = $this->getUser()) ? $user->status : User::STATUS_NOT_ACTIVE;
            if ($this->status === User::STATUS_ACTIVE):
                return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }
}