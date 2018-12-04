<?php

namespace app\common\logic\account;

use app\common\map\CommonMap;

abstract class AbstractAccount
{
    public $wxUnionID = null;
    public $sessionID = null;

    protected static function createSessionID($wxappOpenid, $wxappSessionKey)
    {
        $id = substr(md5($wxappSessionKey), 28);
        $id .= substr(md5($wxappOpenid), 28);

        return md5($id.CommonMap::SESSION_CREATE_SALT.uniqid(mt_rand(), true));
    }
}
