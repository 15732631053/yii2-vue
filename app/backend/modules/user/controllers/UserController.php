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

    /**
     * AppLication: actionLogin  登陆接口
     * Author: hl
     * @return array
     */
    public function actionLogin()
    {
        $this->isRequired(['name', 'pwd']);
        $loginData = $this->json;
        $userinfo = User::validatePassWd($loginData['name'], $loginData['pwd']);
        if ($userinfo) {
            //设置token

            $this->token = UserToken::updataToken($userinfo->id);
            return ['data' => $userinfo->toArray()];
        } else {
            return ['data' => [],'msg'=>'登陆失败'];
        }
    }

    /**
     * AppLication: actionCheckoutName  验证注册用户名接口
     * Author: hl
     * @return array
     */
    public function actionCheckoutName()
    {
        $this->isRequired(['username']);
        $res = User::checkoutName($this->json['username']) ? '1' : '0';
        return ['data' => $res, 'msg' => !$res ? '验证成功' : '用户名重复'];

    }

    /**
     * AppLication: actionRegist  注册接口
     * Author: hl
     * @return array
     */
    public function actionRegist()
    {
        $this->isRequired(['username', 'pwd', 'email']);
        $userModel = new User();
        $res = $userModel->registeUser($this->json);
        return [ 'data'=>$res];

    }
}
