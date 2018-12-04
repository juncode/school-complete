<?php

namespace app\common\logic;

use app\common\logic\account\WxAppAccount;
use app\common\map\ExcCode;
use app\common\util\PageHelper;
use app\common\util\UserID;
use model\Author;
use model\CityModel;
use model\QuestionModel;
use model\QuestionTypeModel;
use model\SchoolModel;
use model\User;
use model\UserAuthorSub;
use model\UserMovieSub;
use model\UserScoreModel;
use model\UserShareModel;
use think\Cache;

/**
 * User: huangjun<j@wonhsi.com>
 * Date: 2018/3/14
 * Time: 15:52.
 */
class OperatorLogic
{
    /**
     * @var array|false|null|\PDOStatement|string|\think\Model
     */
    private $user = null;

    public function __construct($check = false)
    {
        // 初始化用户数据
        $this->user = (new WxAppAccount())->getUserInfo();


        if($check){
            if(empty($this->user->schoolId)){
                send_front_error(ExcCode::EMPTY_ADDRESS_INFO);
            }

            $schoolExist = SchoolModel::where('id', $this->user->schoolId)->value('id');
            if(empty($schoolExist)){
                send_front_error(ExcCode::EMPTY_ADDRESS_INFO);
            }
        }
    }

    public function info()
    {
        $data = [
            'nickname' => $this->user->nickname,
            'avatar' => $this->user->avatar,
            'gender' => $this->user->gender,
        ];

        return $data;
    }

    public function getAllLocation()
    {
        $loc = Cache::get("location-data-json");

        if(!empty($loc)){
            return _json_decode($loc);
        }

        $loc = CityModel::getAll();

        Cache::set("location-data-json", _json_encode($loc), 3600);

        return $loc;
    }

    public function getSchool($pId, $cId, $aId)
    {
        return SchoolModel::getSchool($pId, $cId, $aId);
    }

    public function getQuestion()
    {
        $times = (new User())->checkTimes($this->user->id);

        if(empty($times) || $times <= 0){
            send_front_error(ExcCode::EMPTY_QUESTION);
        }

        $type = "milk_curds";

        $retQuestion = [];

        $others = Cache::get("question-types-json");

        if(empty($others)){
            $others = QuestionTypeModel::getRandom($type);
            Cache::set('question-types-json', _json_encode($others), 3600);
        } else {
            $others = _json_decode($others);
        }

        shuffle($others);

        $selType = array_slice($others, 0, 9);

        array_push($selType, $type);

        $questions = Cache::get("question-list-json");
        if(empty($questions)){
            $questions = QuestionModel::getAll();
            Cache::set('question-list-json', _json_encode($questions), 3600);
        } else {
            $questions = _json_decode($questions);
        }
        foreach ($selType as $item) {
            $rows = $questions[$item];
            shuffle($rows);
            $row = array_pop($rows);

            $option = [];
            !empty($row['option1']) && array_push($option, $row['option1']);
            !empty($row['option2']) && array_push($option, $row['option2']);
            !empty($row['option3']) && array_push($option, $row['option3']);
            shuffle($option);
            $option = array_slice($option, 0, 2);
            array_push($option, $row['correct']);
            shuffle($option);

            $retQuestion[] = [
                'qid' => $row['id'],
                'question' => $row['question'],
                'type' => $row['type'],
                'option' => $option,
                'correct' => $row['correct'],
                'back_img' =>  "/game/{$row['type']}.png",
            ];
        }

        shuffle($retQuestion);

        (new User())->sendQuestion($this->user->id);

        QuestionModel::setViews(array_column($retQuestion, 'qid'));

        return $retQuestion;
    }

    public function getShareCode()
    {
        $id = $this->user->id;

        $share_code = (new UserID($id))->toString();
        $times = $this->user->times;
        $school_name = $this->user->schoolName;

        return compact('share_code', 'times', 'school_name');
    }

    public function getInformationFromShareCode($code)
    {
        $uid = (new UserID($code))->toNumber();

        $info = (new User())->getAddressSchool($uid);

        return $info;
    }

    public function updateUser($data)
    {
        (new User())->where('id', $this->user->id)->update($data);
    }

    public function answer($correct)
    {
        $lastTime = (new User())->getLastQuestionTime($this->user->id);

        if(empty($lastTime)){
            send_front_error(ExcCode::HAS_QUESTION_SUBMIT);
        }

        $time = time();
        $last = strtotime($lastTime);
        if($time - $last > 200){
            send_front_error(ExcCode::ERROR_QUESTION_SUBMIT);
        }

        $a = explode(',', $correct);

        $scores = 0;
        if(!empty($a)){
            $scores = count($a);
            QuestionModel::setRights($a);
            SchoolModel::setSchoolScores($this->user->schoolId,$scores);
        }

        (new User())->setScores($this->user->id, $scores);

        (new UserScoreModel())->record($this->user->id,$scores);

        // 获取学校详情
        $school = SchoolModel::getInfoBySchool($this->user->provinceId, $this->user->schoolId);

        $school['school_inc'] = $scores;

        return $school;
    }

    public function getSchoolRow()
    {
        $country = SchoolModel::getCountRowRank();

        $province = SchoolModel::getProvinceRowRank($this->user->provinceId);

        $myschool = SchoolModel::getInfoBySchool($this->user->provinceId, $this->user->schoolId);

        $province_name = $this->user->provinceName;

        return compact('country', 'province', 'myschool', 'province_name');
    }

    public function incByShare()
    {
        $id = $this->user->id;

        $canInc = (new UserShareModel())->canInc($id);

        if($canInc){
            User::updateTimes($id);
        }

        return true;
    }

}
