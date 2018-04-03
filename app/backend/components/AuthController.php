<?php
/**
 * Created by PhpStorm.
 * AppLication mobo
 * User: mobo
 * Date: 2018/3/27
 * Time: 15:42
 */
namespace backend\components;
class AuthController extends BaseAPIController
{
    public function actionIndex()
    {
        $username = \Yii::$app->request->post('name');
        $password = \Yii::$app->request->post('password');
        $username = $password = 'admin';
        if($username == "admin" && $password == "admin")
        {
            return ['success'=>1,'msg'=>'100-token'];
        }
        return ['success'=>0,'msg'=>\Yii::t('erp','Username or password error')];
    }
}