<?php

return [
    'test_message'=>'测试信息！！！！',
    // 默认发送的机器人
    //默认是公司
    'default' => [
        // 是否要开启机器人，关闭则不再发送消息
        'enabled' => env('DING_ENABLED',true),
        // 机器人的access_token
        'token' => env('DING_TOKEN','b505fb32b5c02eea5b2c3986ab73cc01ca9ee8907a8978e38835e47f25963be9'),
        // 钉钉请求的超时时间
        'timeout' => env('DING_TIME_OUT',2.0)
    ],

    //后勤部门token
    'back_office' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','a3e4795b8b254b13a782435b85d210333b8266b432754d8d598b87eab556fd20'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //售后服务组token
    'service_section' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','a3e4795b8b254b13a782435b85d210333b8266b432754d8d598b87eab556fd20'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //新注册客户token
    'registered_customer' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','f16e5d6ea9ea544eaa5e941c45a67ff2ff864dc88c58b8ebc25c598c8135a097'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //新需求协同token
    'demand_collaboration' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','16f9190bbe966fbfe0b8fa2d9b3b54c5fa508239629931fd15a2c47b134e0362'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //技术部门协同token
    'technical_section_collaboration' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','a3e4795b8b254b13a782435b85d210333b8266b432754d8d598b87eab556fd20'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ]

];