<?php
/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/6/20
 * Time: 09:18.
 */

namespace model;

use app\common\util\PageHelper;
use EasyWeChat\Message\Location;
use think\Model;

class SchoolModel extends Model
{
    protected $table = 'school';

    const WANGZHE = 10;
    const ZHUANSHI = 110;
    const POJIN = 210;
    const HUANGJIN = 310;
    const BAIYING = 510;
    const QINGTONG = 0;

    public static function getSchool($pId, $cId, $aId)
    {
        $where = [];
        !empty($pId) && $where['provinceId'] = $pId;
        !empty($cId) && $where['cityId'] = $cId;
        !empty($aId) && $where['areaId'] = $aId;

        $school = self::where($where)->order('convert(`schoolName` using gbk)')->select();

        $return = [];
        if(!empty($school)){
            $school = $school->toArray();

            foreach ($school as $key => $datum){
                $return[] = ['id' => $datum['id'], 'school' => $datum['schoolName']];
            }
        }

        return $return;
    }

    public static function setSchoolScores($school, $scores)
    {
        !empty($scores) && self::where('id', $school)->setInc('scores', $scores);
    }

    public static function getInfoBySchool($provinceId, $school)
    {
        $school = self::where('id', $school)->find()->toArray();

        $school_score = $school['scores'];
        $school_name = $school['schoolName'];

        $school_prow = self::where('provinceId', $provinceId)->where(['scores' => ['>', $school_score]])->count(1) + 1;

        $school_row = self::where(['scores' => ['>', $school_score]])->count(1) + 1;

        $school_level = self::getLevel($school_prow);

        $school_province = $school['provinceName'];
        $school_city = $school['cityName'];

        return compact('school_score', 'school_prow', 'school_row', 'school_level', 'school_name', 'school_province', 'school_city');
    }


    const LIMIT = 500;
    public static function getProvinceRowRank($provinceId)
    {
        $prank = [];
        $row = self::where('provinceId', $provinceId)->order('scores', 'desc')->order('updated_at', 'desc')->limit(0, self::LIMIT)->select();



        if(!empty($row)){
            $row = $row->toArray();
            foreach ($row as $key => $datum){
                $prow = $key +1;
                $prank[] = [
                    'rank' => $prow,
                    'school' => $datum['schoolName'],
                    'score' => $datum['scores'],
                    'level' => self::getLevel($prow),
                    'city' => CityModel::getCityName($datum['cityId']),
                ];
            }
        }

        return $prank;
    }

    public static function getCountRowRank()
    {
        $rank = [];
        $row = (new self())->order('scores', 'desc')->order('updated_at', 'desc')->limit(0, self::LIMIT)->select();

        if(!empty($row)){
            $row = $row->toArray();
            $prow = []; //临时省名次

            foreach ($row as $key => $datum){
                $trank = $key +1;
                $tprank = isset($prow[$datum['provinceId']]) ? (count($prow[$datum['provinceId']]) + 1 ): 1;

                $prow[$datum['provinceId']][] = $datum['id'];
                $rank[] = [
                    'rank' => $trank,
                    'school' => $datum['schoolName'],
                    'score' => $datum['scores'],
                    'level' => self::getLevel($tprank),
                    'province' => CityModel::getCityName($datum['provinceId'])
                ];
            }
        }

        return $rank;
    }

    private static function getLevel($prow)
    {
        if($prow <= self::WANGZHE){
            return 1;
        }

        if($prow <= self::ZHUANSHI){
            return 2;
        }

        if($prow <= self::POJIN){
            return 3;
        }

        if($prow <= self::HUANGJIN){
            return 4;
        }

        if($prow <= self::BAIYING){
            return 5;
        }

        return 6;
    }
}
