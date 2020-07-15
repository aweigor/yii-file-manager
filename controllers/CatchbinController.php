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

class CatchbinController extends Controller
{

    public function actionIndex()
    {
        $this->layout = "storageLayout";
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["auth/login"]);
        }
        return $this->render('index');
    }

}