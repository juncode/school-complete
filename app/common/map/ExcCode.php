<?php

namespace app\common\map;

class ExcCode
{
    const UPLOAD_FILE_ERROR = ['code' => '501', 'message' => '上传文件失败'];
    /**
     * 通用错误码
     */
    const PARAM_ERROR = ['code' => 3001, 'message' => 'param error'];
    const LOGIC_ERROR = ['code' => 3002, 'message' => 'logic error'];

    /**
     * 通用状态码
     */
    const LOGIN_NO_SESSION = ['code' => 201, 'message' => 'SESSION 过期'];
    const LOGIN_TIME_OUT = ['code' => 201, 'message' => '登录超时'];
    const LOGIN_WECHAT_LOGIN_FAIL = ['code' => 203, 'message' => '登录失败'];
    const USER_NOT_EXIST = ['code' => 204, 'message' => '用户不存在'];
    const LOGIN_COOKIE_ERROR = ['code' => 205, 'message' => '用户cookie不存在'];

    const EMPTY_SN_CODE = ['code' => 206, 'message' => '参数错误，设备sn 或上报数据 为空'];
    const EMPTY_QUESTION = ['code' => 207, 'message' => '参赛次数不够，无法答题'];
    const HAS_QUESTION_SUBMIT = ['code' => 208, 'message' => '答题无效'];
    const ERROR_QUESTION_SUBMIT = ['code' => 208, 'message' => '答题超时，答题无效'];
    const EMPTY_ADDRESS_INFO = ['code' => 210, 'message' => '请先选择学校'];
}
