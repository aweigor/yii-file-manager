<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/16/20
 * Time: 5:04 AM
 */
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use app\models\Folder;
use app\models\User;

class AjaxController extends Controller
{
    const HTML_RESPONSE_ARRAY = [
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
            $usersList = array_map(function($user) {
                return $user->user_name;
            },User::find()->all());
        }

        try {
            if(isset($_POST["Folder"]) && !empty($_POST["Folder"])) {
                $folderModel->fold_id = ;
                $folderModel->fold_desc = ;
                $folderModel->fold_name = ;
                $folderModel->fold_user_id = ;
                $folderModel->users = ;
                $folderModel->fold_id = ;

                if ($folderModel->load($_POST["Folder"]) && $folderModel->save()) {
                    Yii::$app->session->setFlash(
                        'success',
                        "Папка добавлена"
                    );
                } else {
                    Yii::$app->session->setFlash(
                        'error',
                        "При создании папки возникла ошибка! Обратитесь к администратору."
                    );
                }
                return $this->redirect(["catchbin/index"]);
            }
        } catch (BadRequestHttpException $exception) {
            Yii::$app->session->setFlash(
                'error',
                $exception
            );
            $this->goBack();
        };

        $html = [
            "head" => "Новая папка",
            "body" => $this->renderAjax("_formAddFolder",
                [
                    "folder" => $folderModel,
                    "usersList" => $usersList
                ]
            ),
        ] + self::HTML_RESPONSE_ARRAY;

        return json_encode([
            "msg" => "success",
            "html" => $html
        ]);
    }
}