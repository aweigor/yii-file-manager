<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'file_id') ?>

    <?= $form->field($model, 'file_dir') ?>

    <?= $form->field($model, 'file_name') ?>

    <?= $form->field($model, 'file_ext') ?>

    <?= $form->field($model, 'file_color') ?>

    <?php // echo $form->field($model, 'file_comment') ?>

    <?php // echo $form->field($model, 'file_dateloaded') ?>

    <?php // echo $form->field($model, 'file_user_id') ?>

    <?php // echo $form->field($model, 'file_fold_id') ?>

    <?php // echo $form->field($model, 'file_isDeleted') ?>

    <?php // echo $form->field($model, 'file_isPersonal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
