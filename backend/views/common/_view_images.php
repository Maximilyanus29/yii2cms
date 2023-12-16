<?php

use common\components\Support\Support;
use yii\helpers\Url;

?>

<div class="row">
    <?php if (!$model->isNewRecord) : ?>
        <?php $images = $model->getImages() ?>
        <?php if (!empty($images)) : ?>
            <?php foreach ($images as $image) : ?>
                <div class="col-sm-6 img-view">
                    <?php if (!empty($image->id)) : ?>
                        <a href="<?= Url::to(['/' . Support::uncamelCase($image->modelName) . '/image-delete', 'id_img' => $image->id,  'id_model' => $model->id]) ?>">
                            <span class="pull-left btn btn-danger delete-image" style="position: absolute;">
                                <span class="glyphicon glyphicon-remove"></span>
                            </span>
                        </a>
                    <?php endif; ?>
                    <a href="<?= $image->getPathToOrigin() ?>" data-rel="lightcase:g">
                        <img class="image-for-model" src="<?= $image->getPath('200') ?>">
                    </a>
                    <?php if (!empty($image->id)) : ?>
                        <input type="text" id="imagename-name" class="form-control image-text-input" name="ImageNames[<?= $image->id ?>]" value="<?= $image->text ?>" maxlength="254">
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
</div>