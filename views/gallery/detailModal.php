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
            <div class="galery-image-group">
                <?php foreach($files as $key => $file): ?>
                    <?php if(file_exists(Url::base().$file["file_dir"])):?>
                        <img id="<?=$file["file_id"]?>" src="/<?= $file["file_dir"]?>" class="galery-image <?= $key ? "" : "active" ?>">
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <div class="galery-modal-button-group">
                <div class="galery-modal-button" type="button">
                    <a href="#">
                        <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-info"></i></span>
                    </a>
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



            <div class="galery-modal-header modal-header">
            </div>
            <div class="galery-modal-body modal-body">
                <div class="button gallery-slide-button next" type="next" onclick="changeSlideClickEvent(event, 'next')" align="center">
                    <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-chevron-right"></i></span>
                </div>
                <div class="button gallery-slide-button previous" type="prev" style="line-height: 40px;" onclick="changeSlideClickEvent(event, 'prev')" align="center">
                    <span aria-hidden="true" style="font-size: 20px; color: #fff;"><i class="fas fa-chevron-left"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>