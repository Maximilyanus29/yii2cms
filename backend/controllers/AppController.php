<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
пфы
class AppController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'update-grid', 'image-delete'],
                        'allow' => true,
                        'roles' => ['canAdmin'],
                    ],
                ],
            ],
        ];
    }

    public function actionImageDelete($id_model, $id_img)
    {
        $model = $this->findModel($id_model);

        foreach ($model->getImages() as $image) {
            if ($image->id == $id_img) {
                $model->removeImage($image);
                break;
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
