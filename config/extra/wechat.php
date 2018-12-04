<?php

$wechat = [
    'config_key_prefix' => 'wechat_as:app_config',
    'signature_passwod' => '4235674dfsafdhj32fe',
    'mini_program' => [
        'app_id' => 'wx63c36fa0a680a7bf',
        'secret' => '7391aeb3dd04f25fd2975a1665daac41',
//        'token' => 'e0e7a7225cf6a395744f02ef4a6b9c33',
//        'aes_key' => 'vj2oQcbK0Lxo7SNdCZoUfA5nVWl661HIYDCcWyvdVKU',
    ],
    'easywechat' => [
        'app_id' => 'wx63c36fa0a680a7bf',
        'secret' => '7391aeb3dd04f25fd2975a1665daac41',
//        'token' => 'xxmixiangjianwen1',

        /*
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug' => false,
        /*
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level' => 'emergency',
            'file' => RUNTIME_PATH . 'wechat/easywechat.log',
        ],
        /*
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes' => ['snsapi_userinfo'],
            //'callback' => '/examples/oauth_callback.php',
        ],
        /*
         * 微信支付
         */
        'payment' => [
//            'merchant_id' => '1497429332',
//            'key' => 'nJzbBqYGk4QEDkT7rskQF4bTqLwQqVUG',
            //'cert_path' => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            //'key_path' => 'path/to/your/key',      // XXX: 绝对路径！！！！
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            // ...
        ],
        /*
         * Guzzle 全局设置
         *
         * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
         */
        'guzzle' => [
        ],
    ],

];

return append_env_config($wechat, 'wechat');
