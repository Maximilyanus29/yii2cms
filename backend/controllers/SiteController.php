<?php

namespace backend\controllers;

use backend\models\forms\ChangePasswordForm;
use backend\models\forms\LoginForm;
use common\components\Sitemap\Sitemap;
use common\models\Category;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'settings', 'change-password', 'sitemap'],
                        'allow' => true,
                        'roles' => ['canAdmin'],
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

        ];
    }

    public function actions()
    {
        $this->enableCsrfValidation = false;

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'main-login',
            ],
            'settings' => [
                'class' => 'backend\actions\SettingsSiteAction',
                'modelClass' => 'backend\models\Settings',
                'viewName' => 'site-settings'
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'main-login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionChangePassword() {
        $change_pass_form = new ChangePasswordForm();

        if ($change_pass_form->load(Yii::$app->request->post()) && $change_pass_form->validate()) {
            $change_pass_form->save();
            Yii::$app->session->setFlash('info', 'Пароль успешно изменен');
        } else {
            Yii::$app->session->setFlash('error', 'Произошла ошибка при обработке данных');
        }

        return $this->goBack();
    }

    public function actionSitemap()
    {
        $sitemap = new Sitemap();
        $sitemap->generate();

        Yii::$app->session->setFlash('success', 'Файл sitemap.xml успешно сгенерирован');

        return $this->goBack();
    }

}
