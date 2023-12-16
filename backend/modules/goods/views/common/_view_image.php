<?php

use common\components\Support\Support;
use yii\helpers\Url;

?>

<div class="row">
    <?php if (!$model->isNewRecord && !empty($image = $model->getImage())) : ?>
        <div class="col-sm-6 img-view">
            <?php if (!empty($image->id)) : ?>
                <a href="<?= Url::to(['/article/' . Support::uncamelCase($image->modelName) . '/image-delete', 'id_img' => $image->id,  'id_model' => $model->id]) ?>">
                    <span class="pull-left btn btn-danger delete-image">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                </a>
            <?php endif; ?>
            <a href="<?= Url::toRoute($image->getPathToOrigin()) ?>" data-rel="lightcase:g">
                <img class="image-for-model" src="<?= Url::toRoute($image->getPath('200')) ?>">
            </a>
            <?php if (!empty($image->id) && isset($model->behaviors()['ImageNameBehavior'])) : ?>
                <input type="text" id="imagename-name" class="form-control image-text-input" name="ImageNames[<?= $image->id ?>]" value="<?= $image->text ?>" maxlength="254">
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>