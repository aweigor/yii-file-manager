<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/15/20
 * Time: 5:50 AM


 @vars
 * $identity - Object - instance of user identity interface
 * $folders - Array - folders in current selection
 * $owner_id - selection owner (???)
 */

$this->registerCssFile("@web/css/storage/grid-folders.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);
?>

<div class="folders_container">
    <?php if($identity->user_id === $owner_id) : ?>
        <div type="button " id="bt-add-folder" owner="<?= $owner_id?>" data-toggle="modal" data-target="#editModal" class="btn folders_bu-add folders_item">
            <i class="fas fa-plus"></i>
        </div>
    <?php endif;?>

    <?php foreach($folders as $folder): ?>
        <?php
            $enterFolderLink = \yii\helpers\Url::to(['folder/files', 'folder_id' => $folder->fold_id]);
            $removeFolderLink = \yii\helpers\Url::to(['folder/remove', 'folder_id' => $folder->fold_id]);
        ?>

        <div class="btn folders_item folder">
            <div
                    class="folder_toggle_wrap"
                    onmouseover="editGroupMouseOver(event)"
                    onmouseout="editGroupMouseOut(event)"
                    onclick="folderClickEvent('<?php echo $enterFolderLink?>')"
            >
            </div>

            <div class="textarea" align="center">
                <span class="folder-caption"><?= $folder->fold_name?></span>
            </div>

            <?php if($identity->user_id === $folder->fold_user_id): ?>

                <div class="edit_bt_group d-none">
                    <div
                            class="bt-edit-folder"
                            id="edit-folder_<?= $folder->fold_id ?>"
                            owner="<?= $folder->fold_user_id?>"
                            data-toggle="modal"
                            data-target="#editModal"
                    >
                        <a href="#">
                            <span><i class="fas fa-pencil-alt"></i></span>
                        </a>
                    </div>
                    <div>
                        <a href="<?= $removeFolderLink?>">
                            <span><i  class="fas fa-trash"></i></span>
                        </a>
                    </div>
                </div>
            <?php endif;?>
        </div>
    <?php endforeach; ?>
</div>