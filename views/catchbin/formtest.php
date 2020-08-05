<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/5/20
 * Time: 4:08 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
?>

<div class="active-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('users', $selectedUsers, $users, ['class' => 'form-control', 'multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>
</div>