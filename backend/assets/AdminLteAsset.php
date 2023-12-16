<?php

namespace backend\assets;

use yii\web\AssetBundle as BaseAdminLteAsset;

class AdminLteAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@backend/web/adminlte';
    public $css = [
        'css/AdminLTE.css',
        'css/skins/_all-skins.css',
    ];
    public $js = [
        'js/adminlte.js'
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
