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
use app\models\FileUpload;
use yii\helpers\Url;



?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($uploadModel, 'fileInstances')->widget(FileInput::className(), [
        'name' => 'input-ru[]',
        'language' => 'ru',
        'options' => ['multiple' => true, 'accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreviewAsData'=>true,
            'overwriteInitial'=>false,
            'maxFileSize'=> 2800,
            'browseClass' => 'btn btn-success',
            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
            'previewFileType' => 'any',
            'uploadUrl' => Url::to(['ajax/file-upload', 'folder_id' => $folder->fold_id]),]
    ]
)->label(false); ?>

<?php ActiveForm::end() ?>