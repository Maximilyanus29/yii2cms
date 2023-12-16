<?php

use yii\widgets\ActiveForm;
use backend\models\forms\ChangePasswordForm;

$changePasswordForm = new ChangePasswordForm();

?>

<div class="modal fade" id="modal-pass">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['id' => 'change-pass', 'action' => '/admin/site/change-password']); ?>
            <div class="modal-header">
                <div class="row">
                    <div class="col-sm-11">
                        <h4 class="modal-title">Изменение данных аккаунта</h4>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($changePasswordForm, 'new_password')->passwordInput(['placeholder' => '']) ?>
                        <?= $form->field($changePasswordForm, 'repeat_new_password')->passwordInput(['placeholder' => '']) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>