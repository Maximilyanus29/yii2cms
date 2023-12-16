<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use common\models\User;

class AdministratorForm extends Model
{
    public $user_model;
    public $readonly_field = false;

    public $username;
    public $email;
    public $password;
    public $repeat_password;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Логин уже используется.', 'on' => self::SCENARIO_CREATE],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'min' => 2, 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Email уже используется.', 'on' => self::SCENARIO_CREATE],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['repeat_password'], 'required'],
            [['repeat_password'], 'string'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => "Пароли не совпадают"],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'repeat_password' => 'Повторите пароль',
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            $strErrors = array_shift($this->errors)[0];
            Yii::$app->session->setFlash('error', $strErrors);
        }

        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        if ($user->validate() && $user->save()) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole(User::ROLE_ADMIN);
            $auth->assign($role, $user->id);
            Yii::$app->session->setFlash('success', 'Администратор добавлен');

            return $user;
        } else {
            $strErrors = array_shift($user->errors)[0];
            Yii::$app->session->setFlash('error', $strErrors);
        }

        return null;
    }

    public function update()
    {
        $user = $this->user_model;
        if (!empty($user)) {
            $user->password = $this->password;
            $user->save();
        } else {
            Yii::$app->session->setFlash('error', 'Пользователь не найден');
        }

        return true;
    }

    public function loadUserModel($user)
    {
        $this->readonly_field = true;

        $this->user_model = $user;
        $this->username = $user->username;
        $this->email = $user->email;

        return true;
    }
}
