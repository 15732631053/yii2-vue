<?php

namespace backend\modules\user\controllers;

use backend\components\BaseAPIController;
use common\base\User;
use common\base\UserToken;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class UserController extends BaseAPIController
{

    public function actionIndex()
    {
        $id = $this->decodeID('uid');
        $this->isRequired([], true);
        $model = User::find()->where('id=:uid', [':uid' => $id])->asArray()->one();
        $this->reponseType = 'item';
        return ['data' => $model];
    }

    public function actionIndex2()
    {
        $id = $this->decodeID('id');
        $this->isRequired([], true);
        $model = User::find()->where('id=:id', [':id' => $id])->asArray()->one();
        return ['data' => $model];
    }

    public function actionLogin()
    {
        $this->isRequired(['name', 'password']);
        $loginData = $this->json;
        $userinfo = User::validatePassWd($loginData['name'], $loginData['password']);
        if ($userinfo) {
            //设置token

            $this->token = UserToken::updataToken($userinfo->id);
            return ['data' => $userinfo->toArray()];
        } else {
            return ['data' => [2]];
        }
    }
}
