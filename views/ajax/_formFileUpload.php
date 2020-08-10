<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/10/20
 * Time: 4:35 AM
 */

use kartik\file\FileInput;;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\File;
use yii\helpers\Url;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$form = ActiveForm::begin([
    'id' => 'file-upload-form',
    'options' => ['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'],
]);
?>
    <div id="ajax-form-body">
        <?= $form->field($fileModel, 'file_user_id')->hiddenInput()->label(false); ?>

        <?php
            echo $form->field($uploadModel, 'fileInstances')->widget(FileInput::classname(), [
                'name' => 'input-ru[]',
                'language' => 'ru',
                'options' => ['multiple' => true, 'accept' => 'image/*'],
                'pluginOptions' => [
                        'initialPreviewAsData'=>true,
                    'overwriteInitial'=>false,
                    'maxFileSize'=>2800,
                        'browseClass' => 'btn btn-success',
        'uploadClass' => 'btn btn-info',
        'removeClass' => 'btn btn-danger',
                        'removeIcon' => '<i class="fas fa-trash"></i>',
                        'previewFileType' => 'any', 'uploadUrl' => Url::to(['folder/files', 'folder_id' => $folder->fold_id]),]
            ])->label(false);
        ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Создать папку', ['class' => 'btn btn-primary', 'id' => 'ajax-form-submit']) ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end() ?>