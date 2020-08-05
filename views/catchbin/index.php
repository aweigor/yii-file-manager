<?php
/* @vars $ownFolders - Active Record Collection - user folders */

    $this->title = "Мой каталог";

    $this->registerCssFile("@web/css/storage/index.css",
        [
            'rel' => 'stylesheet',
            'depends'=> ['app\assets\AppAsset']
        ]
    );

    $identity = Yii::$app->user->identity;
?>


<?php echo $this->render("_gridFolders",
    [
        "owner_id" => $identity->user_id,
        "identity" => $identity,
        "folders" => $ownFolders
    ])
?>