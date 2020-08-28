<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/27/20
 * Time: 12:53 PM
 */

/*
 * @var files - Array - list of files
 *
 * */

use yii\helpers\Url;

$this->registerCssFile("@web/css/storage/gallery.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);

?>
<div class="gallery-modal-wrapper">
    <div class="gallery-modal-container">


    </div>
</div>

<div class="modal galery-modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="galery-modal-dialog modal-dialog" role="document">
        <div class="galery-modal-content modal-content">
            <div class="galery-modal-body modal-header" style="height:60px;background: black; padding:0;border:none">
            </div>
            <div class="galery-modal-body modal-body">
                <div class="galery-image-group">
                    <?php foreach($files as $key => $file): ?>
                        <?php if(file_exists(Url::base().$file["file_dir"])):?>
                            <?php if(in_array($file["file_ext"],['png','jpg','jpeg'])):?>
                                <img id="<?=$file["file_id"]?>" src="/<?= $file["file_dir"]?>" class="galery-image <?= $key ? "" : "active" ?>">
                            <?php else: ?>
                                <img id="<?=$file["file_id"]?>" src="/images/folder.png" class="galery-image <?= $key ? "" : "active" ?>">
                            <?php endif;?>
                            <div class="gallery-popover collapsed" id="pp_<?=$file["file_id"]?>">
                                <p align="right"><span><i class="fas fa-times"></i></span></p>
                                <div class="toggle-area" style="position: absolute; right:0; top:0; width: 30px;height: 30px; background: transparent" onclick="closePopover(event)"></div>
                                <ul>
                                    <li><strong>Имя файла: </strong><?=$file["file_name"]?></li>
                                    <li><strong>Тип файла: </strong><?=$file["file_ext"]?></li>
                                    <li><strong>Комментарий: </strong><?=$file["file_comment"]?></li>
                                    <li><strong>Дата загрузки: </strong><?=date("m.d.y",$file["file_dateloaded"])?></li>
                                </ul>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
                <div class="button gallery-slide-button next" type="next" onclick="changeSlideClickEvent(event, 'next')" align="center">
                    <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-chevron-right"></i></span>
                </div>
                <div class="button gallery-slide-button previous" type="prev" style="line-height: 40px;" onclick="changeSlideClickEvent(event, 'prev')" align="center">
                    <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-chevron-left"></i></span>
                </div>
            </div>
            <div class="galery-modal-button-group">
                <div class="galery-modal-button" style="position:relative" type="button">
                    <a href="#">
                        <span aria-hidden="true"  style="font-size: 20px; color: #fff;" ><i class="fas fa-info"></i></span>
                    </a>
                    <div class="toggle-area gallery-info" style="position: absolute; margin-top:-25px; margin-left:-10px; width: 30px;height: 30px; background: transparent" id="ppbt_<?php echo isset($files[0]) ? $files[0]['file_id'] : ''?>" onclick="showPopover(event)"></div>
                </div>
                <div  class="galery-modal-button" type="button">
                    <a id="gallery-download" href="<?php if(isset($files[0])) Url::to(['folder/download-file', 'file_id' => $files[0]["file_id"]])?>">
                        <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-angle-double-down"></i></span>
                    </a>

                </div>
                <div  class="galery-modal-button" type="button">
                    <a id="gallery-remove" href="<?php if(isset($files[0])) Url::to(['folder/remove-file', 'file_id' => $files[0]["file_id"]])?>">
                        <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-trash"></i></span>
                    </a>
                </div>
                <div class="galery-modal-button" type="button" data-dismiss="modal" aria-label="Close">
                    <a href="#">
                        <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-times"></i></span>
                    </a>
                </div>
            </div>




        </div>
    </div>
</div>