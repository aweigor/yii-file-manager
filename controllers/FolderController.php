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
use app\models\File;
use app\models\User;
use yii\web\Controller;
use Yii;

class FolderController extends Controller
{
    public function actionRemove($folder_id) {
        if (empty($folder_id)) echo "no folder id provided";

        $folder = Folder::findOne($folder_id);
        $folder->delete();
        return $this->redirect(["catchbin/index"]);
    }

    public function actionCatalog($uid = null) {

        $this->layout = "storageLayout";

        if (Yii::$app->user->isGuest) {
            return $this->redirect(["auth/login"]);
        } else {
            $user = User::findOne(Yii::$app->user->id);
        }

        if(!empty($uid) && $uid != Yii::$app->user->id) {
            $folders = $user->getSharedFoldersByUid($uid);
        } else {
            $uid = Yii::$app->user->id;
            $folders = Folder::find()
                ->where(['fold_user_id' => $uid])
                ->all();
        }
        $this->view->params['catalogOwner'] = $uid;

        return $this->render('catalog', [
            "folders" => $folders
        ]);
    }

    public function actionFiles($folder_id) {
        $this->layout = "storageLayout";

        $folder = Folder::findOne($folder_id);
        $identity = Yii::$app->user->identity;
        $uploadModel = new FileUpload();
        $fileSearch = new FileSearch();
        $filesProvider = $fileSearch->search($_GET);
        $this->view->params['catalogOwner'] = $folder->fold_user_id;

        return $this->render("files", [
            'folder' => $folder,
            'uploadModel' => $uploadModel,
            'searchModel' => $fileSearch,
            'identity' => $identity,
            'filesProvider' => $filesProvider
        ]);
    }

    public function actionRemoveFile($file_id) {
        if (empty($file_id)) return "no file id provided";

        $file = File::findOne($file_id);
        $folder_id = $file->file_fold_id;
        $file->remove();
        return $this->redirect(['folder/files','folder_id' => $folder_id]);
    }

    public function actionDownloadFile($file_id) {
        if (empty($file_id)) return "no file id provided";

        $file = File::findOne($file_id);
        if(!empty($file->file_dir) && is_dir($file->file_dir)) {
            $fileDir = $file->file_dir;
        } else {
            $fileDir = 'uploads/storage/'
                .$file->file_fold_id . '/'
                .md5($file->file_dateloaded) . '.'
                .$file->file_ext;
        }

        if (file_exists($fileDir)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$file->file_name.'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($fileDir));
            readfile($fileDir);
            exit;
        }

        return false;
    }
}