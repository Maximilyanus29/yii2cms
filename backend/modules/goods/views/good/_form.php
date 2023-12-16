<?php

use common\models\Category;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="item-form">
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Основные</a></li>
                    <li><a href="#tab_2" data-toggle="tab">SEO</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-sm-9">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                <?=
                                $form->field($model, 'category_id')->widget(Select2::class, [
                                    'data' => Category::getListForSelect('name'),
                                    'options' => ['placeholder' => 'Выберите категорию'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'tabindex' => false,
                                        'tags' => false,
                                        'tokenSeparators' => [',', ' '],
                                    ],
                                ])->label('Категория');
                                ?>
                                <?= $form->field($model, 'slug')->textInput(['readonly' => true]) ?>

                                <div class="col-sm-6">
                                    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($model, 'old_price')->textInput(['type' => 'number']) ?>
                                </div>

                                <?= $form->field($model, 'description')->widget(common\widgets\CkeditorSite::class, []) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'is_public', ['options' => ['class' => 'form-group cust-checkbox'], 'template' => '<label> {input} <span class="cust-checkbox__box"></span> Опубликовать</label>'])->checkbox([], false);  ?>
                                <?= $form->field($model, 'images')->fileInput(['accept' => "image/jpeg, image/png"]) ?>
                                <?= $this->render('/common/_view_images', compact('model')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <?= $this->render('/common/_seo', compact('form', 'model')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success save-btn']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>