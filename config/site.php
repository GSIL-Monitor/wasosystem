<?php
return [
       'member_center_links_pic'=>'/pic/more_black.png',
       "member_center_links"=>[
           '产品服务'=>[
               'parts_buy.index'=>['name'=>'配件选购','image'=>'P_pei.png'],
               'common_equipments.index'=>['name'=>'常用配置','image'=>'P_chang.png'],
               'orders.index'=>['name'=>'我的订单'],
               'funds_managements.index'=>['name'=>'资金管理','image'=>'P_money.png'],
               'quality'=>['name'=>'质保管理'],
               'collect.index'=>['name'=>'我的收藏','image'=>'P_shopColl.png'],
//               'query'=>'产品查询',
           ],
           '个人中心'=>[
               'notifications.index'=>['name'=>'消息通知','image'=>'P_message.png'],
               'personal_details.index'=>['name'=>'个人信息','image'=>'P_shopMe.png'],
               'user_companies.index'=>['name'=>'企业信息','image'=>'P_company.png'],
               'user_addresses.index'=>['name'=>'收货地址','image'=>'P_shou.png'],
               'personal_details.password_edit'=>['name'=>'密码修改','image'=>'P_shopPass.png'],
               'binding_authorization.index'=>['name'=>'绑定授权','image'=>'P_bind.png'],
           ]
       ],
        "member_center_order_links"=>[
            'all_orders'=>'全部订单',
            'intention_to_order'=>'意向订单',
            'placing_orders'=>'下单订货',
            'order_acceptance'=>'受理订单',
            'in_transportation'=>'在途运输',
            'arrival_of_goods'=>'成交订单',
            'old_orders'=>'老站订单',
        ],
        "member_center_order_invoice"=>[
            'vat_special_invoice'=>'单位采购',
            'no_invoice'=>'个人采购'
        ],
        'member_center_personal_details'=>['Mr'=>'男士','lady'=>'女士','privary'=>'保密'],
        'member_center_invoice'=>['no_invoice'=>'个人采购','vat_special_invoice'=>'单位采购'],
        'index_newType'=>['company_dynamic'=>'公司动态','industry_trends'=>'行业动态','technical_expertise'=>'技术知识'],
        'news_type_en'=>['gongsi'=>'company_dynamic','hangye'=>'industry_trends','jishu'=>'technical_expertise'],
        'news_type_cn'=>['gongsi'=>'网烁动态','hangye'=>'行业新闻','jishu'=>'技术知识'],
        'server_price'=>[
            '5999以下'=> ['1',5999],
            '6000元-9999元'=>[6000,5999],
            '10000元-19999元'=>[10000,19999],
            '20000元-39999元'=>[20000,39999],
            '40000元以上'=>[40000,1000000]
        ] ,
       'order_type'=>['waso_complete_machine'=>2,'custom_complete_machine'=>3,'designer_computer'=>4]
];


