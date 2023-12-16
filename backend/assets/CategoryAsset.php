<?php

namespace backend\assets;

use yii\web\AssetBundle;

class CategoryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/category/init.js'
    ];

    public $depends = [
        AppAsset::class
    ];
}
