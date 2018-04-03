<?php

namespace backend\modules\user\controllers;

use backend\components\BaseAPIController;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class DefaultController extends BaseAPIController
{
    public $author= 'ddd';
    public function actionIndex()
    {
        return ['data'=>['de',2,3]];
    }
}
