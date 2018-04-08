<?php

namespace backend\modules\article\controllers;

use backend\components\BaseAPIController;
use common\base\Article;
use yii\web\Controller;

/**
 * Default controller for the `article` module
 */
class ArticleController extends BaseAPIController
{

    /**
     * AppLication: actionList  文章列表
     * Author: hl
     * @return array
     */
    public function actionList()
    {
        $model = new Article();
        $model = $model->getList($this->json);
        $this->reponseType='list';
        return ['data'=>$model['res'],'counts'=>$model['counts'],'page'=>$this->json['page']];
    }

    /**
     * AppLication: actionDetail  查看文章
     * Author: hl
     * @return array
     */
    public function actionDetail(){
        $this->isRequired(['id']);
        $id=$this->decodeID('id');
        $model= Article::findOne($id)->toArray();
        return ['data'=>$model];
    }

    /**
     * AppLication: actionCreate    增加文章
     * Author: hl
     * @return array
     */
    public function actionCreate(){
//        $this->isRequired(['uid']);
        $uid=1;
//        $id=$this->decodeID('id');
        $params=[
            'title'=>$this->json['title'],
            'content'=>$this->json['content'],
            'uid'=>strval($uid),
            'created_time'=>time(),
            'updated_time'=>time(),
        ];
        $model=new Article();
        $model->setAttributes($params,false);
        $model->save();
        return ['data'=>'success'];
    }
}
