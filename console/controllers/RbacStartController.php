<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

// php yii migrate/up --migrationPath=@vendor/pheme/yii2-settings/migrations
// php yii migrate --migrationPath=@yii/rbac/migrations/
// php yii rbac-start/init

class RbacStartController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        try {
            // Добавление роли "user"
            $user = $auth->createRole('user');
            $user->description = 'Пользователь';
            $auth->add($user);

            // Добавление роли "manager"
            $manager = $auth->createRole('manager');
            $manager->description = 'Менеджер';
            $auth->add($manager);

            // Добавление роли "admin"
            $admin = $auth->createRole('admin');
            $admin->description = 'Администратор';
            $auth->add($admin);

            // Право администрирования
            $permitCanAdmin = $auth->createPermission('canAdmin');
            $permitCanAdmin->description = 'Администрирование';
            $auth->add($permitCanAdmin);

            $user = $auth->getRole('user');
            $manager = $auth->getRole('manager');
            $admin = $auth->getRole('admin');
            $permitCanAdmin = $auth->getPermission('canAdmin');

            $auth->addChild($admin, $permitCanAdmin);
            $auth->addChild($manager, $permitCanAdmin);
        } catch (\Throwable $th) {
            echo "RBAC role not init in this moment:( \n";
        }

        echo "RBAC role init \n";
    }
}
