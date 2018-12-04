<?php
/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/6/20
 * Time: 09:18.
 */

namespace model;

use think\Model;

class UserScoreModel extends Model
{
    protected $table = 'user_score';

    public function record($uid, $scores, $corrects ='', $questions = '')
    {
        self::insert(compact('uid', 'scores', 'corrects', 'questions'));
    }
}
