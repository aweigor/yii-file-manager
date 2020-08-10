<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/9/20
 * Time: 8:10 AM
 */

namespace app\controllers;

use app\models\Folder;
use app\models\FileUpload;
use app\models\FileSearch;
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

        $folder = Folder::findOne($folder_id);
        $identity = Yii::$app->user->identity;
        $uploadModel = new FileUpload();
        $fileSearch = new FileSearch();
        $filesProvider = $fileSearch->search([]);

        return $this->render("files", [
            'folder' => $folder,
            'uploadModel' => $uploadModel,
            'identity' => $identity,
            'filesProvider' => $filesProvider
        ]);
    }
}