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
            $editModel = new Folder();
            $editModel->fold_user_id = Yii::$app->user->id;
        }

        try {
            if(isset($_POST["Folder"]) && !empty($_POST["Folder"])) {
                if ($editModel->load($_POST["Folder"]) && $editModel->save()) {
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
                    "model" => $editModel,
                ]
            ),
        ] + self::HTML_RESPONSE_ARRAY;

        return json_encode([
            "msg" => "success",
            "html" => $html
        ]);
    }
}