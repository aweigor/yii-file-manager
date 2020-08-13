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
    $catalogOwner = isset($this->params['catalogOwner']) ? $this->params['catalogOwner'] : $identity->user_id;
?>


<?php echo $this->render("_gridFolders",
    [
        "owner_id" => $catalogOwner,
        "identity" => $identity,
        "folders" => $folders,
    ])
?>