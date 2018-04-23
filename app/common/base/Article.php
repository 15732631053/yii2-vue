<?php

namespace common\base;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "yx_article".
 *
 * @property int $id
 * @property string $uid
 * @property string $title
 * @property string $content
 * @property int $created_time
 * @property int $updated_time
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yx_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'title', 'content'], 'required'],
            [['content'], 'string'],
            [['created_time', 'updated_time'], 'integer'],
            [['uid', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'title' => 'Title',
            'content' => 'Content',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
    public  function getList($config){
        $uid = $config['uid']?$config['uid']:0;
        $offset=($config['page']-1)*$config['pagesize'];
        $count=self::find()->where('uid=:uid',['uid'=>$uid])->count();
        $page = new Pagination(['defaultPageSize' => isset($config['pagesize']) ? $config['pagesize'] : 10, 'totalCount' => $count]);
        $data= self::find()->select('id,title,created_time,updated_time')->where('uid=:uid',['uid'=>$uid])
            ->offset($offset)->limit($page->limit)->orderBy('updated_time desc')->asArray()->all();
        return ['res'=>$data,'counts'=>$count];
    }
}
