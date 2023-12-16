<?php

use common\widgets\CkeditorSite;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Настройки';

Yii::$app->cache->flush();
Yii::$app->frontendCache->flush();

$settings = Yii::$app->settings;
$settings->clearCache();

?>

<div class="site-index">
  <div class="row">
    <div class="col-sm-12">
      <h1> <?= $this->title ?> </h1>
    </div>
  </div>
  <div class="row">

    <div class="col-md-8">
      <div class="settings-tabs">

        <?php $form = ActiveForm::begin(['id' => 'site-settings-form']); ?>
        <div class="beauty-container nav-tabs-custom">

          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Основные</a></li>
            <li><a href="#tab_2" data-toggle="tab">SEO</a></li>
            <li><a href="#tab_3" data-toggle="tab">Почта</a></li>
            <li><a href="#tab_4" data-toggle="tab">Организация</a></li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

              <div class="row">
                <div class="col-md-6">
                  <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-md-6">
                  <?= $form->field($model, 'phone') ?>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <?= $form->field($model, 'text_about')->widget(CkeditorSite::class, []) ?>
                </div>
              </div>

            </div>

            <div class="tab-pane" id="tab_2">

              <div class="row">
                <div class="col-md-12">
                  <?= $form->field($model, 'h1') ?>
                  <?= $form->field($model, 'title') ?>
                  <?= $form->field($model, 'keywords') ?>
                  <?= $form->field($model, 'description')->textarea(['rows' => '5']) ?>
                </div>
              </div>

            </div>

            <div class="tab-pane" id="tab_3">

              <div class="row">
                <div class="col-sm-6">
                  <?= $form->field($model, 'smtp_username')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">
                  <?= $form->field($model, 'smtp_password')->textInput(['maxlength' => true]) ?>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4">
                  <?= $form->field($model, 'smtp_host')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                  <?= $form->field($model, 'smtp_port')->input('number') ?>
                </div>
                <div class="col-sm-4">
                  <?= $form->field($model, 'smtp_encrypt')->dropDownList(['ssl' => 'SSL', 'tls' => 'TLS']) ?>
                </div>
              </div>

            </div>

            <div class="tab-pane" id="tab_4">

              <div class="row">
                <div class="col-sm-12">
                  <?= $form->field($model, 'organization_domain') ?>
                  <?= $form->field($model, 'organization_name') ?>
                  <?= $form->field($model, 'organization_address') ?>
                </div>
              </div>

            </div>
          </div>

          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success save-btn']) ?>

        </div>
        <?php ActiveForm::end(); ?>

      </div>
    </div>

    <div class="col-md-3">
      <div class="beauty-sub-container nav-tabs-custom">
        <div class="tab-content">
          <h3>Статистика</h2>

            <div class="row">
              <div class="col-md-12">
                <?php $file = Yii::getAlias('@app/../sitemap.xml'); ?>
                <?php if (file_exists($file)) : ?>
                  Карта <a target="_blank" href="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl('/sitemap.xml') ?>"> <b> sitemap.xml</b></a> обновлена: <?= date("d.m.y в H:i:s", filemtime($file)); ?>
                  <br>
                <?php endif; ?>
              </div>
            </div>

        </div>
      </div>
    </div>

  </div>
</div>