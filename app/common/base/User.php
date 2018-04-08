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
    public static function validatePassWd($name, $pwd)
    {
        return self::find()->where('username=:name and password=:pwd', [':name' => $name, ':pwd' => $pwd])->one();

    }

    /**
     * AppLication: registeUser  注册用户
     * Author: hl
     * @param $data
     * @return bool
     */
    public function registeUser($data)
    {
        if ($this->beforeRegist($data)) {
            $model = new User();
            $params = [
                'username' => $data['username'],
                'password' => $data['pwd'],
                'email' => $data['email'],
                'created_at' => time(),
                'updated_at' => time(),
            ];
            $model->setAttributes($params, false);
            $res = $model->save();


        }
        if (!$res) return false;
        return $this->afterRegist($data);

    }

    protected function beforeRegist($data)
    {
        return true;
    }

    protected function afterRegist($data)
    {
        //hook
        return true;

    }

    public static function checkoutName($name)
    {
        return self::find()->where('username=:name ', [':name' => $name])->one();
    }
}
