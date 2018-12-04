<?php

namespace app\common\util;

use Doctrine\Common\Cache\RedisCache;
use EasyWeChat\Foundation\Application;

class WechatHelper
{
    /**
     * 目前使用的小程序的appid
     *
     * @return Application
     */
    public static function sdk()
    {
        $sdk = new Application(config('wechat.easywechat'));

        return $sdk;
    }

    public static function wxapp()
    {
        $wxapp = request()->post('ch', '');

        $cname = empty($wxapp) ? 'wechat' : "wechat_{$wxapp}";

        $sdk = new Application(config($cname));

        return $sdk->mini_program;
    }

    public static function payment()
    {
        return self::sdk()->payment;
    }
}
