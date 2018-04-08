<?php
namespace backend\controllers;

use backend\components\BaseAPIController;
use common\base\User;
use Yii;
use yii\rest\Controller;

/**
 * Site controller
 */
class IndexController extends BaseAPIController
{
    public $author='hl';
    public function actionIndex()
    {

        return ['data'=>['index'],'msg'=>'index api'] ;
    }

}
