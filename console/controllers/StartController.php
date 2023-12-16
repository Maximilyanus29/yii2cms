<?php

namespace console\controllers;

use yii\console\Controller;

class StartController extends Controller
{
    public function actionIndex()
    {
        echo "Running migrations: \n";

        \Yii::$app->runAction('migrate/up', ['--migrationPath' => '@vendor/pheme/yii2-settings/migrations']);
        \Yii::$app->runAction('migrate/up', ['--migrationPath' => '@vendor/costa-rico/yii2-images/migrations']);
        \Yii::$app->runAction('migrate/up', ['--migrationPath' => '@yii/rbac/migrations/']);
        \Yii::$app->runAction('migrate/up');

        echo "Create default user rules: \n";

        \Yii::$app->runAction('rbac-start/init');
        \Yii::$app->runAction('rbac-admin-assign/init');
    }
}
