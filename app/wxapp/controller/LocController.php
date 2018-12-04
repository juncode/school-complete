<?php

namespace app\wxapp\controller;

use app\common\logic\OperatorLogic;
use model\CityModel;

class LocController
{
    public function all()
    {
        $data = (new OperatorLogic())->getAllLocation();

        return success_return($data);
    }

    public function school()
    {
        $provinceId = request()->get('provinceId');
        $cityId = request()->get('cityId');
        $areaId = request()->get('areaId');

        $data = (new OperatorLogic())->getSchool($provinceId, $cityId, $areaId);

        return success_return($data);
    }
}
