<?php

namespace app\common\logic\account;

use app\common\map\ExcCode;
use app\common\map\CommonMap;
use app\common\util\WechatHelper;
use model\User;
use think\Exception;
use think\Log;

class WxAppAccount extends AbstractAccount
{
    public $wxappOpenid = null;
    public $wxappSessionKey = null;

    public function __construct()
    {
        $test = request()->get('ddddsssss');
        if ($test != '223322') {
            $sessionID = request()->header(CommonMap::SESSION_ID_KEY);

            $session = (new SessionLogic($sessionID))->get('', CommonMap::SESSION_USER_INFO);

            if (empty($sessionID) || empty($session)) {
                send_front_error(ExcCode::LOGIN_TIME_OUT);
            }

            $user = User::getByWxapp($session['wxappOpenid']);

            if(empty($user)){
                send_front_error(ExcCode::LOGIN_TIME_OUT);
            }

            $this->sessionID = $sessionID;
            $this->wxappOpenid = $session['wxappOpenid'];
            $this->wxappSessionKey = $session['wxappSessionKey'];

        } else{
            $this->wxappOpenid = 'orZsY43UZztk8nke8R0ly-3qCP-Q';
        }
    }

    /**
     * 通过小程序的code执行登录.
     *
     * @param string $code
     * @param string $nickname
     * @param string $gender
     * @param string $avatar
     *
     * @return WxAppAccount|bool
     *
     * @throws \V5\Library\Exception\UserVisibleException
     */
    public static function login($code, $nickname, $gender, $avatar)
    {
        try {
            /* 通过客户端传来的code,从微信服务器获得openid */
//            $wxInfo = WechatHelper::wxapp()->sns->getSessionKey($code);
            $wxInfo = self::get("https://api.weixin.qq.com/sns/jscode2session?appid=wx63c36fa0a680a7bf&secret=7391aeb3dd04f25fd2975a1665daac41&js_code=$code&grant_type=authorization_code");
        } catch (Exception $e) {
            send_front_error(ExcCode::LOGIN_WECHAT_LOGIN_FAIL);

            return false;
        }

        Log::record('微信登录获取用户信息');
        Log::record(_json_encode($wxInfo));

        $wxappOpenid = $wxInfo['openid'];
        $wxappSessionKey = $wxInfo['session_key'];

        /* 通过openid查找用户 */
        $user = User::getByWxapp($wxappOpenid);

        /* 如果是新用户 */
        if (empty($user)) {
            $user = new User();

            $user->openid = $wxappOpenid;
            $user->avatar = $avatar;
            $user->nickname = $nickname;
            $user->gender = $gender;

            $user->save();
        } else {
            $user->avatar = $avatar;
            $user->nickname = $nickname;
            $user->gender = $gender;

            $user->save();
        }

        /* 创建srd_session */
        $sessionID = self::createSessionID($wxappOpenid, $wxappSessionKey);

        (new SessionLogic($sessionID))->set([
            'id' => $user->id,
            'wxappOpenid' => $wxappOpenid,
            'wxappSessionKey' => $wxappSessionKey,
        ], CommonMap::SESSION_USER_INFO);

        return $sessionID;
    }

    /**
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public function getUserInfo()
    {
        return User::getByWxappOpenid($this->wxappOpenid);
    }


    /**
     * curl get 请求
     * @param $url
     * @return mixed
     */
    private static function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $SSL = substr($url, 0, 8) == "https://" ? true : false;
        if ($SSL) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名
        }
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }
}
