<?php

namespace common\base;

use Yii;

/**
 * This is the model class for table "yx_user_token".
 *
 * @property int $id
 * @property string $uid
 * @property string $token
 * @property int $expired
 */
class UserToken extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yx_user_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'token', 'expired'], 'required'],
            [['expired'], 'integer'],
            [['uid', 'token'], 'string', 'max' => 255],
            [['uid'], 'unique'],
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
            'token' => 'Token',
            'expired' => 'Expired',
        ];
    }

    /**
     * AppLication: checkToken  检查token  refresh token
     * Author: hl
     * @param $uid int 用户id
     * @param $token string token
     * @return bool|mixed|string
     */
    public static function checkToken($uid, $token)
    {
        $token = self::find()->where('uid=:uid and token=:token', [':uid' => $uid, ':token' => $token])->one();
        if (!$token) return null;
        if($token->expired < time()) return 0;
        return $token->token;

    }

    /**
     * AppLication: updataToken  更新token
     * Author: hl
     * @param $uid int 用户id
     * @return mixed  token
     */
    public static function updataToken($uid)
    {
        $token = self::find()->where('uid=:uid', [':uid' => $uid])->one();
        $params = [
            'token' => md5(time()),
            'expired' => time() + 7 * 24 * 60 * 60, //7 days
        ];
        if (!$token) {
            $token = new UserToken();
            $params['uid'] = strval($uid);
        }
        $token->setAttributes($params, false);
        $token->save();
        return $params['token'];
    }
}
