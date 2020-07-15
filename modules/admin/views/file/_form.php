<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_id')->textInput() ?>

    <?= $form->field($model, 'file_dir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_ext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_dateloaded')->textInput() ?>

    <?= $form->field($model, 'file_user_id')->textInput() ?>

    <?= $form->field($model, 'file_fold_id')->textInput() ?>

    <?= $form->field($model, 'file_isDeleted')->textInput() ?>

    <?= $form->field($model, 'file_isPersonal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
