<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/16/20
 * Time: 4:32 AM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile( "@web/css/storage/file-form.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);

$form = ActiveForm::begin([
    'id' => 'edit-file-form',
    'options' => ['class' => 'form-horizontal'],
])
?>
<div id="ajax-form-body">
    <?= $form->field($file, 'file_name') ?>
    <?= $form->field($file, 'file_comment') ?>
    <?= $form->field($file, 'file_isPersonal')->checkbox()  ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary', 'id' => 'ajax-form-submit']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
