<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/16/20
 * Time: 5:04 AM
 */
namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use app\models\Folder;
use app\models\User;
use app\components\helpers\Ajax;

class AjaxController extends Controller
{
    const HTML_RESPONSE_TEMPLATE = [
        "head" => null,
        "body" => null,
        "bottom" => null
    ];

    public function actionNewFolder()
    {
        if(!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException();
        }

        if(Yii::$app->user->isGuest) {
            return $this->redirect(["auth/login"]);
        } else {
            $folderModel = new Folder();
            $folderModel->fold_user_id = Yii::$app->user->id;
            $folderModel->users = $selectedUsers = $folderModel->getSelectedUsers();
            $users = ArrayHelper::map(User::find()->all(), 'user_id', 'user_name');
        }

        if(isset($_POST["formData"]) && !empty($_POST["formData"])) {
            try {
                $formData = Ajax::ParseFormData(json_decode($_POST["formData"], true), "Folder");

                $folderModel->fold_user_id = $formData["fold_user_id"];
                $folderModel->fold_name = $formData["fold_name"];
                $folderModel->fold_desc = $formData["fold_desc"];

                if ($folderModel->save()) {
                    if(isset($formData["users"]) && !empty($formData["users"])) {
                        $folderModel->bindUsers($formData["users"]);
                    }

                    Yii::$app->session->setFlash(
                        'success',
                        "Папка добавлена"
                    );
                    return $this->redirect(["catchbin/index"]);
                } else {
                    throw new BadRequestHttpException("error while saving model !");
                }

            } catch (BadRequestHttpException $exception) {
                Yii::$app->session->setFlash(
                    'error',
                    $exception
                );
                $this->goBack();
            };
        }

        $html = [
            "head" => "Новая папка",
            "body" => $this->renderAjax("_formAddFolder",
                [
                    "folder" => $folderModel,
                    "users" => $users,
                    "selectedUsers" => $selectedUsers
                ]
            ),
        ] + self::HTML_RESPONSE_TEMPLATE;

        return json_encode([
            "msg" => "success",
            "html" => $html
        ]);
    }
}