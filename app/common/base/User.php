<?php

namespace common\base;

use Yii;

/**
 * This is the model class for table "yx_user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yx_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * AppLication: validatePassWd
     * Author: hl
     * @param $name
     * @param $pwd
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function validatePassWd($name,$pwd){
        return self::find()->where('username=:name and password=:pwd',[':name'=>$name,':pwd'=>$pwd])->one();

    }
    public function registeUser($name,$pwd){
        if($this->beforeRegist($name,$pwd)){

        }
        $this->afterRegist($name,$pwd);

    }
    protected function beforeRegist($name,$pwd){

    }
    protected function afterRegist($name,$pwd){
        //hook

    }
}
