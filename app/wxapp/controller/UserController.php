<?php

namespace app\wxapp\controller;

use app\common\logic\account\WxAppAccount;
use app\common\logic\OperatorLogic;
use app\common\map\ExcCode;
use model\SchoolModel;

class UserController
{
    /**
     * 登录.
     *
     * @return array
     *
     * @throws \V5\Library\Exception\UserVisibleException
     */
    public function login()
    {
        $code = request()->post('code');
        $nickname = request()->post('nickname');
        $gender = request()->post('gender');
        $avatar = request()->post('avatar_url');

        if (empty($code)) {
            send_front_error(ExcCode::PARAM_ERROR, 'code empty');
        }

        $token = WxAppAccount::login($code, $nickname, $gender, $avatar);

        return success_return(compact('token'));
    }

    /**
     * 获取用户信息.
     *
     * @return array
     */
    public function userInfo()
    {
        $data = $this->operator()->info();

        return success_return($data);
    }

    public function getQuestion()
    {
        $data = $this->operator()->getQuestion();

        return success_return($data);
    }

    public function getShareCode()
    {
        $data = $this->operator(true)->getShareCode();

        return success_return($data);
    }

    public function getByShareCode()
    {
        $code = request()->get('share_code');

        if (empty($code)) {
            send_front_error(ExcCode::PARAM_ERROR);
        }

        $info = $this->operator()->getInformationFromShareCode($code);

        return success_return($info);
    }

    public function updateAddress()
    {
        $provinceId = request()->post('provinceId');
        $provinceName = request()->post('provinceName');
        $cityId = request()->post('cityId');
        $cityName = request()->post('cityName');
        $areaName = request()->post('areaName');
        $areaId = request()->post('areaId');
        $schoolName = request()->post('schoolName');
        $schoolId = request()->post('schoolId');

        if(empty($provinceName) || empty($cityName) || empty($areaName) || empty($schoolId) || empty($schoolName)) {
            send_front_error(ExcCode::PARAM_ERROR);
        }

        $this->operator()->updateUser(compact('provinceId', 'provinceName', 'cityId', 'cityName', 'areaId', 'areaName', 'schoolId', 'schoolName'));

        SchoolModel::where('id', $schoolId)->setInc('users');

        return success_return();
    }

    public function submitQuestion()
    {
        $corrects = request()->get('corrects');

        $data = $this->operator()->answer($corrects);

        return success_return($data);
    }

    public function rank()
    {
        $data = $this->operator()->getSchoolRow();

        return success_return($data);
    }

    public function shareFunc()
    {
        $this->operator()->incByShare();

        return success_return();
    }

    private function operator($check = false)
    {
        return new OperatorLogic($check);
    }
}
