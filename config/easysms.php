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
            'aliyun',
            'qcloud',
            'yuntongxun',
            'yunpian',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'aliyun' => [
            'access_key'        => env('ALIYUN_ACCESSKEYID'), // accessKey
            'access_secret'     => env('ALIYUN_ACCESSKEYSECRET'), // accessSecret
            'sign_name'         => env('ALIYUN_SMS_SIGN_NAME'), // 签名
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
        'yunpian' => [
            'api_key' => env('YUNPIAN_API_KEY'),
        ],
    ],
];