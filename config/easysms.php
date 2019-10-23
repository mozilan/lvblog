<?php
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'yunpian',
            'aliyun',
            'qcloud',
            'yuntongxun',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'yunpian' => [
            'api_key' => env('YUNPIAN_API_KEY'),
            'signature' =>env('YUNPIAN_API_SIGNATURE',''), // 内容中无签名时使用
        ],
        'aliyun' => [
            'access_key_id' => env('ALIYUN_ACCESSKEYID'),
            'access_key_secret' => env('ALIYUN_ACCESSKEYSECRET'),
            'sign_name' => env('ALIYUN_SMS_SIGN_NAME'), // 签名
        ],
        'qcloud' => [ 
            'sdk_app_id' => env('QCLOUD_SDK_APP_ID'), // SDK APP ID
            'app_key' => env('QCLOUD_APP_KEY'), // APP KEY
            'sign_name' => env('QCLOUD_SIGN_NAME' , ''), // 短信签名，如果使用默认签名，该字段可缺省（对应官方文档中的sign）
        ],
        'yuntongxun' => [
            'account_sid' => env('RONGLIAN_ACCOUNT_SID'),
            'account_token' => env('RONGLIAN_AUTH_TOKEN'),
            'app_id' => env('RONGLIAN_APP_ID'),
            'is_sub_account' => false,
        ],
    ],
];