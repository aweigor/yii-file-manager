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

    public function actionFolder($folder_id = NULL)
    {
        $html = $users = $formData = [];
        $headContent = $bodyContent = $footerContent = "";
        $folderModel = $formType = NULL;

        if(!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException();
        }

        if(Yii::$app->user->isGuest) {
            return $this->redirect(["auth/login"]);
        } else {
            if($folder_id || isset($_POST["folder_id"])) {
                $one = $folder_id !== NULL ? $folder_id : $_POST["folder_id"];
                $folderModel = Folder::findOne($one);
                $folderModel->users = $selectedUsers = $folderModel->getSelectedUsers();
                $formType = "EditFolder";
            } else {
                $folderModel = new Folder();
                $folderModel->fold_user_id = Yii::$app->user->id;
                $folderModel->users = $selectedUsers = $folderModel->getSelectedUsers();
                $formType = "AddFolder";
            }
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

        $headContent = $folderModel->fold_name !== NULL ? "Редактирование ".$folderModel->fold_name: "Новая папка";
        $bodyContent = $this->renderAjax("_form".$formType,
            [
                "folder" => $folderModel,
                "users" => $users,
                "selectedUsers" => $selectedUsers
            ]
        );

        $html = [
            "head" => $headContent,
            "body" => $bodyContent,
        ] + self::HTML_RESPONSE_TEMPLATE;

        return json_encode([
            "msg" => "success",
            "html" => $html
        ]);
    }
}