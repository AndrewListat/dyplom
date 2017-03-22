<?php
/**
 * Created by PhpStorm.
 * User: Listat
 * Date: 29.11.2015
 * Time: 12:04
 */
namespace app\modules\ls_admin\models;
use yii\base\Model;
use Yii;

class RegForm extends Model
{
    public $username;
    public $lastname;
    public $login;
    public $email;
    public $password;
    public $status;
    public function rules()
    {
        return [
            [['login', 'email', 'password'],'filter', 'filter' => 'trim'],
            [['login', 'email', 'password'],'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['lastname', 'string', 'min' => 2, 'max' => 255],
            ['login', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.'],
            ['login', 'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя уже занято.'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
            ]],
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'login' => 'Имя пользователя',
            'email' => 'Эл. почта',
            'password' => 'Пароль'
        ];
    }
    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->lastname = $this->lastname;
        $user->login = $this->login;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->role = 'admin007';
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->password = $this->password;
        return $user->save() ? $user : null;
    }
    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name.' (отправлено роботом).'])
            ->setTo($this->email)
            ->setSubject('Активация для '.Yii::$app->name)
            ->send();
    }
}