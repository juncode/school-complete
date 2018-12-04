<?php
/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/6/13
 * Time: 17:57
 */

namespace app\common\util;

class PageHelper
{
    public static function page()
    {
        $page = request()->get('page', 1);
        $limit = request()->get('limit', 500);

        return compact('page', 'limit');
    }
}