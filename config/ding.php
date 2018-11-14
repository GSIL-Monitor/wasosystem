<?php

return [

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

        'token' => env('OTHER_DING_TOKEN','af15e7555affe27138d2b11661dc0ca5f7804e0f7babf9a9f6b59da64da68c3c'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //售后服务组token
    'service_section' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','17ed6a032f0bfb8631bd1f513d950ec41b8326cb8d092185da7afbd08aebaae7'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //新注册客户token
    'registered_customer' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','8838985bddff8f07af1c250240213f4e8c2939400fa1d80ae8c3ac8ca2794d74'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //新需求协同token
    'demand_collaboration' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','4e9e4d121bac04fc04ff86ed2e5ddf741f3faffd6e62849eb22fe08eeaff2180'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ],
    //技术部门协同token
    'technical_section_collaboration' => [
        'enabled' => env('OTHER_DING_ENABLED',true),

        'token' => env('OTHER_DING_TOKEN','a3e4795b8b254b13a782435b85d210333b8266b432754d8d598b87eab556fd20'),

        'timeout' => env('OTHER_DING_TIME_OUT',2.0)
    ]

];