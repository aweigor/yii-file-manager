<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/27/20
 * Time: 12:45 PM
 */

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class FilesGallery extends Widget
{
    public $files;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->renderFile('@views/gallery/detailModal.php', [
            'files' => $this->files
        ]);
    }
}