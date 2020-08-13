<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/10/20
 * Time: 4:58 PM
 *
 * @var $model - File Model
 */

use yii\helpers\Url;

$baseUrl = Url::to('@web/uploads/storage/');

$imageExts = ['png','jpeg'];

if(!empty($model->file_dir) && is_dir('/'.$model->file_dir)) {
    $imageDir = '/'.$model->file_dir;
} else {
    $imageDir = $baseUrl
        .$model->file_fold_id . '/'
        .md5($model->file_dateloaded) . '.'
        .$model->file_ext;
}

if(!in_array($model->file_ext, $imageExts)) {
    $imageDir = Url::to('@web/images/folder.png');
}

?>

<div class="details_container row">
    <div class="details_image_preview col-4">
        <img src="<?=$imageDir;?>" class="file_details_image"/>
    </div>
    <div class="details_file_info col-8">
        <ul>
            <li><strong>Имя файла:</strong><?=$model->file_name?></li>
            <li><strong>Тип файла:</strong><?=$model->file_ext?></li>
            <li><strong>Комментарий:</strong><?=$model->file_comment?></li>
            <li><strong>Дата загрузки:</strong><?=$model->file_dateloaded?></li>
            <li><strong>Владелец:</strong><?=$model->user->user_name?></li>
        </ul>
    </div>
</div>
