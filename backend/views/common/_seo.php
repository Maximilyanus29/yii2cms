<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model->seo, 'h1')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model->seo, 'title')->textInput() ?>
        <?= $form->field($model->seo, 'keywords')->textInput() ?>
        <?= $form->field($model->seo, 'description')->textarea(['rows' => 4, 'onkeyup' => 'myVar.lenghtChar(this)']) ?>
    </div>
</div>