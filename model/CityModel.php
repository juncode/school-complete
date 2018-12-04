<?php
/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/06/20
 * Time: 09:18.
 */

namespace model;

use think\Model;

class CityModel extends Model
{
    protected $table = 'city';

    public static function getAll()
    {
        $all = self::all()->toArray();

        $province = [];
        $city = [];
        $area = [];

        foreach ($all as $key => $datum){
            if($datum['provinceId'] == 0){
                $province[$datum['name']] = $datum['id'];
            }else if($datum['cityId'] == 0){
                $temp = array_flip($province);
                $city[$temp[$datum['provinceId']]][$datum['name']] = $datum['id'];
            }
        }

        foreach ($all as $datum) {
            if($datum['provinceId'] !=0 && $datum['cityId'] != 0){
                $temp = array_flip($province);
                if(isset($city[$temp[$datum['provinceId']]])){
                    $t =  $city[$temp[$datum['provinceId']]];
                    $tt = array_flip($t);
                    $tcity = isset($tt[$datum['cityId']]) ? $tt[$datum['cityId']] : $temp[$datum['provinceId']];
                } else {
                    $tcity =  $temp[$datum['provinceId']];
                }
                $area[$tcity][$datum['name']] = $datum['id'];
            }
        }

        return compact('province', 'city','area');
    }

    private static $city = null;
    public static function getCityName($id)
    {
        if(is_null(self::$city)){
            self::$city = self::all()->column('name', 'id');
        }

        return self::$city[$id];
    }
}
