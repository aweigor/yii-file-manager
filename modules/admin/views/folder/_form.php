<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Folder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fold_id')->textInput() ?>

    <?= $form->field($model, 'fold_user_id')->textInput() ?>

    <?= $form->field($model, 'fold_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fold_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fold_desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
