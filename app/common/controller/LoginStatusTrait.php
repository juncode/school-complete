<?php

namespace app\common\controller;

use app\common\logic\account\WxAppAccount;
use app\common\map\ExcCode;
use app\common\map\CommonMap;
use think\Session;

trait LoginStatusTrait
{
    /**
     * 获得登录信息 如果获取失败则抛出session错误
     *
     * @return WxAppAccount
     *
     * @throws \V5\Library\Exception\UserVisibleException
     */
    protected function getAccountOrExist()
    {
        return new WxAppAccount();
    }
}
