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
use app\models\FileUpload;
use app\models\File;
use app\components\helpers\Ajax;
use yii\web\UploadedFile;

class AjaxController extends Controller
{
    const HTML_RESPONSE_TEMPLATE = [
        "head" => null,
        "body" => null,
        "bottom" => null
    ];

    public $uploadErrors;

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
            $users = array_filter($users, function ($item) {
                return $item != Yii::$app->user->id;
            }, ARRAY_FILTER_USE_KEY);
        }

        if(isset($_POST["formData"]) && !empty($_POST["formData"])) {
            try {
                $formData = json_decode($_POST["formData"], true);
                $formData = Ajax::ParseFormData($formData, "Folder");

                if(isset($formData["fold_user_id"]) && !empty($formData["fold_user_id"])) {
                    $folderModel->fold_user_id = $formData["fold_user_id"];
                }

                if(isset($formData["fold_name"]) && !empty($formData["fold_name"])) {
                    $folderModel->fold_name = $formData["fold_name"];
                }

                if(isset($formData["fold_desc"]) && !empty($formData["fold_desc"])) {
                    $folderModel->fold_desc = $formData["fold_desc"];
                }

                if ($folderModel->save()) {
                    if(isset($formData["users"]) && !empty($formData["users"])) {
                        $folderModel->bindUsers($formData["users"]);
                    } elseif ($formType == "EditFolder") {
                        $folderModel->unbindUsers();
                    }

                    Yii::$app->session->setFlash(
                        'success',
                        "Папка добавлена"
                    );

                    return $this->redirect(["folder/catalog"]);
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
            "msg" => $users,
            "html" => $html
        ]);
    }

    public function actionFileUpload($folder_id) {
        $folder = Folder::findOne($folder_id); // todo: $folder->fold_user_id - folder owner check
        $uploadModel = new FileUpload();

        if (Yii::$app->request->isPost) {
            $uploadModel->fileInstances = UploadedFile::getInstances($uploadModel, 'fileInstances');

            if($uploadModel->validate()) {
                foreach($uploadModel->fileInstances as $file) {
                    $time = time();
                    $fileDir = $uploadModel->upload($file, $folder, $time);
                    $fileModel = new File();
                    $fileModel->file_dir = $fileDir;
                    $fileModel->file_name = $file->baseName;
                    $fileModel->file_ext = $file->extension;
                    $fileModel->file_user_id = Yii::$app->user->id;
                    $fileModel->file_fold_id = $folder_id;
                    $fileModel->file_dateloaded = $time;
                    $fileModel->file_isDeleted = false;
                    $fileModel->file_isPersonal = false;

                    if ($fileModel->validate()) {
                        $fileModel->save();
                    } else {
                        $this->uploadErrors[$file->baseName] = $fileModel->getErrors();
                    }
                }
            } else {
                $errors = json_encode($uploadModel->getErrors());
                return $errors;
            }
            $errors = $this->uploadErrors;
            if(!empty($errors)) {
                return json_encode($errors);
            } else {
                return $this->redirect(['folder/files', 'folder_id' => $folder_id]);
            }
        }
        return null;
    }

    public function actionFileEdit($file_id = null) {
        $html = $formData = [];
        $fileModel = $formType = $folder_id = NULL;

        if(!Yii::$app->request->isAjax) {
            throw new BadRequestHttpException("request must be ajax");
        }

        if(Yii::$app->user->isGuest) {
            return $this->redirect(["auth/login"]);
        } else {
            if(!$file_id) {
                if(!empty($_POST["file_id"])) {
                    $fileModel = File::findOne($_POST["file_id"]);
                } else {
                    throw new BadRequestHttpException("no file id");
                }
            } else {
                $fileModel = File::findOne($file_id);
            }
            $folder_id = $fileModel->file_fold_id;
            $formType = "EditFile";
        }

        if(isset($_POST["formData"]) && !empty($_POST["formData"])) {
            try {
                $formData = json_decode($_POST["formData"], true);
                $formData = Ajax::ParseFormData($formData, "File");

                if(isset($formData["file_name"]) && !empty($formData["file_name"])) {
                    $fileModel->file_name = $formData["file_name"];
                }

                if(isset($formData["file_isPersonal"]) &&  !empty($formData["file_isPersonal"])) {
                    $fileModel->file_isPersonal = $formData["file_isPersonal"];
                } else {
                    $fileModel->file_isPersonal = false;
                }

                if(isset($formData["file_comment"]) && !empty($formData["file_comment"])) {
                    $fileModel->file_comment = $formData["file_comment"];
                }

                if ($fileModel->save()) {
                    Yii::$app->session->setFlash(
                        'success',
                        "Папка добавлена"
                    );
                    return $this->redirect(["folder/files", "folder_id" => $folder_id]);
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

        $headContent = "<h6>Редактирование".$fileModel->file_name."</h6>";
        $bodyContent = $this->renderAjax("_form".$formType,
            [
                "file" => $fileModel
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