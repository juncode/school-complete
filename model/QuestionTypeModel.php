<?php
/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/6/20
 * Time: 09:18.
 */

namespace model;

use think\Model;

class QuestionTypeModel extends Model
{
    protected $table = 'question_type';

    public static function getRandom($type = null)
    {
        $all = self::all()->toArray();

        $types = array_column($all, 'type');

        foreach ($types as $key => $datum) {
            if($datum == $type){
                unset($types[$key]);
            }
        }

        return $types;
    }
}
