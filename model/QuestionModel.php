<?php
/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/6/20
 * Time: 09:18.
 */

namespace model;

use think\Model;

class QuestionModel extends Model
{
    protected $table = 'question';

    public static function getAll()
    {
        $return = [];

        $questions = self::all()->toArray();

        foreach ($questions as $key => $datum){
            $return[$datum['type']][] = $datum;
        }

        return $return;
    }

    public static function setRights($qid)
    {
        return (new self())->whereIn('id', $qid)->setInc('rights');
    }

    public static function setViews($qid)
    {
        return (new self())->whereIn('id', $qid)->setInc('views');
    }
}
