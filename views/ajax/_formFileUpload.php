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

?>

<?php
echo FileInput::widget([
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
]);
?>