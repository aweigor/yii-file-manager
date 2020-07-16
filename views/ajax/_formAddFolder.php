<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/16/20
 * Time: 4:32 AM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile( "@web/css/storage/add-folder-form.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);

$form = ActiveForm::begin([
    'id' => 'new-folder-form',
    'options' => ['class' => 'form-horizontal'],
])
?>
<div id="ajax-form-body">
    <?= $form->field($model, 'fold_user_id')->hiddenInput()->label(false); ?>
    <?= $form->field($model, 'fold_name') ?>
    <?= $form->field($model, 'fold_desc') ?>
    <?= $form->field($model, 'fold_image') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Создать папку', ['class' => 'btn btn-primary', 'id' => 'ajax-form-submit']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
