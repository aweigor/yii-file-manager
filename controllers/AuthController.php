<?php
/**
 * Created by PhpStorm.
 * User: drmnnml
 * Date: 25/03/2020
 * Time: 19:19
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use app\models\LoginForm;
use Yii;

class AuthController extends Controller
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTest()
    {
        $user = User::findOne(1);
        Yii::$app->user->login($user);

       # var_dump(Yii::$app->user);die();
        if(Yii::$app->user->isGuest) {
            echo "Гость";
        } else {
            echo "Авторизован";
        }
    }
}