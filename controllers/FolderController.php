<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/9/20
 * Time: 8:10 AM
 */

namespace app\controllers;

use app\models\Folder;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use Yii;

class FolderController extends Controller
{
    public function actionRemove($folder_id) {
        if (empty($folder_id)) throw new BadRequestHttpException;

        $folder = Folder::findOne($folder_id);
        $folder->delete();
        return $this->redirect(["catchbin/index"]);
    }

    public function actionFiles($folder_id) {
        $this->layout = "storageLayout";
        return $this->render("files");
    }
}