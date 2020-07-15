<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/15/20
 * Time: 8:14 AM
 */
use app\models\User;

// Пользователи, которые дали доступ к папке
$friends = User::find();

$this->registerCssFile("@web/css/storage/layout.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);
?>
<?php $this->beginContent('@views/layouts/storageModal.php'); ?>
<?php $this->endContent(); ?>

<?php $this->beginContent('@views/layouts/main.php'); ?>
    <div class="storage_container container">

        <div class="storage_header row">
            Поиск
        </div>

        <div class="storage_body row">

            <div class="storage_sided_bar col-3">
                content
            </div>

            <div class="storage_content_view col-9">
                <?= $content ?>
            </div>

        </div>

    </div>
<?php $this->endContent(); ?>