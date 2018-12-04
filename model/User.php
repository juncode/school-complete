<?php

namespace model;

use think\Model;

/**
 * Class User.
 *
 * @property int id                        自增id
 * @property string openid         微信小程序openid
 * @property string avatar               头像
  * @property string gender                 性别
 * @property string nickname               昵称
 * @property string dev_sn               设备编号
 * @property string mobile               手机号
 * @property int created_at          用户上次登录时间
 * @property int updated_at          更新时间
 */
class User extends Model
{
    // 隐藏属性
    protected $table = 'user';
    protected $pk = 'id';

    /**
     * 某个用户ID是否存在.
     *
     * @param int $id 用户数字ID
     *
     * @return bool
     */
    public static function isExist($id)
    {
        $where = compact('id');
        $find = self::where($where)->value('id');

        if (!empty($find)) {
            return true;
        }

        return false;
    }

    public static function getAddressSchool($id)
    {
        $find = self::where('id', $id)->field('id,openid,nickname,avatar,gender,scores,times,created_at,updated_at', true)->find();

        if(empty($find)){
            return [];
        }

        return $find->toArray();
    }

    /**
     * @param $wxappOpenid
     * @return array|false|\PDOStatement|string|Model
     */
    public static function getByWxappOpenid($wxappOpenid)
    {
        $where = ['openid' => $wxappOpenid];

        $user = self::where($where)->find();

        return $user;
    }

    public static function getByWxapp($openid)
    {
        $query = self::where('openid', $openid);

        $user = $query->find();

        return $user;
    }

    public static function getByNickName($nickname)
    {
        $query = self::where('nickname', $nickname);

        $user = $query->find();

        return $user;
    }

    public function sendQuestion($id)
    {
        self::where('id', $id)->setDec('times');

        self::where('id', $id)->update(['send_at' => get_date_time()]);

        return true;
    }

    public function getLastQuestionTime($id)
    {
        return self::where('id', $id)->value('send_at');
    }

    public function setScores($id, $scores)
    {
        self::where('id', $id)->update(['send_at' => null]);

        !empty($scores) && self::where('id', $id)->setInc('scores', $scores);
    }

    public function checkTimes($id)
    {
        return self::where('id', $id)->value('times');
    }

    public static function updateTimes($id)
    {
        return self::where('id', $id)->setInc('times');
    }
}
