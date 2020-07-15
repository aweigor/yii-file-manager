<?php
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
        "owner" => $identity->user_name,
        "identity" => $identity
    ])
?>