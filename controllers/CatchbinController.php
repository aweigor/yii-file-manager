<?php
/**
 * Created by PhpStorm.
 * User: drmnnml
 * Date: 25/03/2020
 * Time: 21:06
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\Folder;

class CatchbinController extends Controller
{

    public function actionIndex()
    {
        $this->layout = "storageLayout";

        if (Yii::$app->user->isGuest) {
            return $this->redirect(["auth/login"]);
        }

        $ownFolders = Folder::find()
            ->where(['fold_user_id' => Yii::$app->user->identity->user_id])
            ->all();

        $this->view->params['catalogOwner'] = Yii::$app->user->id;

        return $this->render('index', [
            "ownFolders" => $ownFolders
        ]);
    }

    public function actionFormtest()
    {
        $selectedUsers = [1]; // $folder->getSelectedUsers
        $users = [
            1 => 'User1',
            2 => 'User2'
        ];
        return $this->render('formtest', [
            'users' => $users,
            'selectedUsers' => $selectedUsers
        ]);
    }
}