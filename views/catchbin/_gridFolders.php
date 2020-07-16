<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/15/20
 * Time: 5:50 AM
 */

$this->registerCssFile("@web/css/storage/grid-folders.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);
?>

<div class="folders_container">
    <?php if($identity->user_id === $owner_id) :?>
        <div type="button " id="bt-add-folder" owner="<?= $owner_id?>" data-toggle="modal" data-target="#editModal" class="btn btn-demo folders_bu-add folders_item"></div>
    <?php endif;?>
</div>