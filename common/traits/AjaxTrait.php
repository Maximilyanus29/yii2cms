<?php
namespace common\traits;

use yii\web\JqueryAsset;
use yii\web\YiiAsset;
use yii\widgets\ActiveFormAsset;

trait AjaxTrait
{
    public function sendAjaxResponse(array $data = [])
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->response->data = $data;

        \Yii::$app->assetManager->bundles = [
            JqueryAsset::class => false,
            YiiAsset::class => false,
            ActiveFormAsset::class => false,
        ];

        return \Yii::$app->response->send();
    }
}