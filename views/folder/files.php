<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/9/20
 * Time: 9:45 AM
 */

$this->title = "Мой каталог";

$this->registerCssFile("@web/css/storage/index.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);