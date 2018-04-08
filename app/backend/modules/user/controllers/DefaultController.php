<?php

namespace backend\modules\user\controllers;

use backend\components\BaseAPIController;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class DefaultController extends BaseAPIController
{
    public $author= 'hl';
    public function actionIndex()
    {
        return ['data'=>'default user api'];
    }
}
