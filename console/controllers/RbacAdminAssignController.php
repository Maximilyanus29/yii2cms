<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;
use yii\console\ExitCode;
use yii\helpers\Console;

// php yii rbac-admin-assign/init 1

class RbacAdminAssignController extends Controller
{
    const DEFAULT_USER_EMAIL = 'admin@admin.ru';
    const DEFAULT_USER_PASSWORD = 'changethispassword';

    public function actionInit($id = NULL)
    {
        $id = ($id == NULL) ? $this->idFirstAdmin() : $id;

        // Есть ли пользователь с таким id
        $user = (new User())->findIdentity($id);
        if (!$user) {
            $this->stdout("User witch id:'$id' is not found!\n", Console::BG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // Получаем объект yii\rbac\DbManager, который назначили в конфиге для компонента authManager
        $auth = Yii::$app->authManager;

        // Получаем объект роли
        $role = $auth->getRole('admin');

        // Удаляем все роли пользователя
        $auth->revokeAll($id);

        // Присваиваем роль админа по id
        $auth->assign($role, $id);

        // Выводим сообщение об успехе и возвращаем соответствующий код
        $this->stdout("Done!\n", Console::BOLD);
        return ExitCode::OK;
    }

    private function idFirstAdmin()
    {
        $user = User::find()->where(['email' => self::DEFAULT_USER_EMAIL])->one();

        if (empty($user)) {
            $user = new User();
            $user->email = self::DEFAULT_USER_EMAIL;
            $user->setPassword(self::DEFAULT_USER_PASSWORD);
            $user->generateAuthKey();
            $user->username = $user->email;
            $user->status = User::STATUS_ACTIVE;
            $user->save();
        }

        return $user->id;
    }
}
