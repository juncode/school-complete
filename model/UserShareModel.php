<?php
/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/6/20
 * Time: 09:18.
 */

namespace model;

use think\Model;

class UserShareModel extends Model
{
    protected $table = 'user_share';

    public function canInc($uid)
    {
        $date = date("Y-m-d");

        $record = self::where('uid', $uid)->where('date', $date)->count(1);

        if($record < 3){
            self::insert(compact('uid', 'date'));
            return true;
        }

        return false;
    }
}
