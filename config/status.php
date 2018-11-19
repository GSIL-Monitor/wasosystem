<?php
return [
    'yingyong_type'=>[1=>'对应参数','对应选项'],
    "procuctParamentselectShow" => ['input' => '文本显示', 'select' => '单选', 'checkbox' => '复选', 'radio' => '是与否'],
    "procuctGoodStatus" => ['show'=>'展示', 'main_current'=>'主流','recommend'=>'推荐','hot'=>'热门', 'hide'=>'隐藏','halt_production'=>'停产'],
    "procuctGoodPrices" => ['retail_price'=>'零售价', 'member_price'=>'会员价','cooperation_price'=>'合作价','core_price'=>'核心价','cost_price'=>'成本价','taobao_price'=>'淘宝价'],
    "complete_machine_framework"=>['framework'=>'架构','Application'=>'应用','filtrate'=>'筛选问题','answer'=>'筛选答案'],
    "complete_machine_framework_select_type"=>['radio'=>'单选','checkbox'=>'多选'],
    "complete_machine_framework_radio_type"=>['filtrate'=>'问题','answer'=>'答案','product'=>'产品'],
    "complete_machine_marketing"=>['none'=>'无','new'=>'新品','hot'=>'热卖','moods'=>'人气','sale'=>'折扣'],
    "information_management_marketing"=>['original'=>'原创','hot'=>'热门','boutique'=>'精品','choiceness'=>'精选'],
    "complete_machine_prices" => ['retail_price'=>'零售价', 'member_price'=>'会员价','cooperation_price'=>'合作价','core_price'=>'核心价','cost_price'=>'成本价','taobao_price'=>'淘宝价','balance'=>'差额'],
    'user'=>['VerifiedUser'=>'认证会员','Unverified'=>'未认证会员','BlockedAccount'=>'冻结账户'],
    'userStatus'=>['tax_rate'=>'会员税率','grade'=>'会员级别',
                   'service'=>'服务模式','source'=>'会员来源',
                   'invoice'=>'开票类型','order_type'=>'订单类型',
                   'order_status'=>'订单状态','payment_status'=>'款项状态',
                    'customer_status'=>'客户状态','demand_status'=>'需求状态'
    ],

    'userIndustry'=>[
        'IT|通信|电子|互联网'=>['互联网/电子商务','计算机软件','IT服务(系统/数据/维护)','电子技术/半导体/集成电路','计算机硬件','通信/电信/网络设备','网络游戏'],
        '金融业'=>['基金/证券/期货/投资','保险','银行','信托/担保/拍卖/典当'],
        '房地产|建筑业'=>['房地产/建筑/建材/工程','家居/室内设计/装饰装潢','物业管理/商业中心'],
        '商业服务'=>['专业服务/咨询(财会/法律/人力资源等)','广告/会展/公关','中介服务','检验/检测/认证','外包服务'],
        '贸易|批发|零售|租赁业'=>['快速消费品（食品/饮料/烟酒/日化）','耐用消费品（服饰/纺织/皮革/家具/家电）','贸易/进出口','租赁服务'],
        '文体教育|工艺美术'=>['教育/培训/院校','礼品/玩具/工艺美术/收藏品/奢侈品'],
        '生产|加工|制造'=>['汽车/摩托车','大型设备/机电设备/重工业','加工制造（原料加工/模具）','仪器仪表及工业自动化','印刷/包装/造纸','办公用品及设备','医药/生物工程','医疗设备/器械','航空/航天研究与制造'],
        '交通|运输|物流|仓储'=>['交通/运输','物流/仓储'],
        '服务业'=>['医疗/护理/美容/保健/卫生服务','酒店/餐饮','旅游/度假'],
        '文化|传媒|娱乐|体育'=>['媒体/出版/影视/文化传播','娱乐/体育/休闲）'],
        '能源|矿产|环保'=>['能源/矿产/采掘/冶炼','石油/石化/化工','电气/电力/水利','环保'],
        '政府|非盈利机构'=>['政府/公共事业/非盈利机构','学术/科研'],
        '农|林|牧|渔|其他'=>['农/林/牧/渔','跨领域经营','其他'],
    ],
    'userInfo'=>['all_receiving'=>'全接收','no_receiving'=>'不接受','email_receiving'=>'邮件接收','phone_receiving'=>'手机接收'],
    'user_invoice'=>['无需发票'=>'无需发票','增值税普通发票'=>'增值税普通发票','增值税专用发票'=>'增值税专用发票'],
    'old_status'=>[0=>'意向订单',1=>'下单订货',2=>'订单受理',3=>'在途运输',4=>'确认到货'],
    'old_fund'=>[0 => '未付货款', 1 => '支付定金', 2 => '货到付款', 3 => '已付货款'],
    'old_fund'=>[0 => '未付货款', 1 => '支付定金', 2 => '货到付款', 3 => '已付货款'],
    'visitor_details_valid'=>['no' => '无效客户', 'yes' => '有效客户'],
    'visitor_details_contact_count'=>['one' => '第一次联系', 'two' => '两次以上'],
    'menus_cats'=>['web'=>'网站系统','tiao'=>'条码系统'],
    'admin_role_permission'=>[
        "admins"=>'管理员',
        "roles"=>'角色',
        "permissions"=>'权限',
    ],
    'job_type'=>['product'=>'产品类','skill'=>'技术类','marketing'=>'营销类','functions'=>'职能类'],
    'service_directory_type'=>['buying_guide'=>'购买指南','terms_of_service'=>'服务条款','after_sale_policy'=>'售后政策','other_description'=>'其他说明'],
    'information_managements_type'=>['company_dynamic'=>'公司动态','industry_trends'=>'行业动态','technical_expertise'=>'技术知识'],
    'banner_font_float'=>['left'=>'左','right'=>'右','center'=>'居中'],
    'banner_font_color'=>['B'=>'B','W'=>'W','Logo'=>'Logo'],
    'service_quality_assurance_status'=>['quality_assurance_apply_for'=>'质保申请',
                                        'quality_assurance_to_accept'=>'质保受理',
                                        'quality_assurance_to_perform'=>'质保执行',
                                        'quality_assurance_to_finish'=>'质保完成',
                                        'no_quality_assurance'=>'无须质保',

    ],
    'service_quality_assurance_event'=>['A'=>'A，配置方案错误、不匹配、兼容性、无法安装等方案问题；',
                                        'B'=>'B，收到货品与购买名品、规格、数量不符等配货问题；',
                                        'C'=>'C，开机有问题\重启\蓝屏\死机\有异响\按键无效\指示灯异常\软硬件报错等技术问题；',
                                        'D'=>'D，有变形、摔伤、破损及漏发要求资料或物料等打包物流问题；',
                                        'E'=>'E，正常质保，无人为责任；',
    ],
    'service_quality_assurance_model'=>['complete_machine'=>'整机质保','parts'=>'配件质保','manual_service'=>'人工服务'],
    'business_management_category'=>[38=>'buying_guide',39=>'terms_of_service',40=>'after_sale_policy',41=>'other_description'],


    /*******************************条码关联状态************************************/
    'procurement_plans_status'=>['procurement'=>'计划列表','finish'=>'已购列表'],
    'procurement_plans_statuss'=>['procurement'=>'未入库','finish'=>'已入库','unfinished'=>'入库未完'],
    'procurement_plans_type'=>['procurement'=>'采购','test'=>'测试品'],
    'procurement_plans_colour'=>['new'=>'新品','good'=>'良品','bad'=>'坏货'],
    'warehouse_out_managements_type'=>['sell'=>'销售','loan_out'=>'借出'],
    'warehouse_out_managements_status'=>['unfinished'=>'出库未完','finish'=>'出库完成','inventory_machine'=>'库存整机'],
    'barcode_associateds_menu'=>['barcode_associated'=>'关联列表','loan_out'=>'借出列表','quality_acceptance'=>'质保列表',
                                'bad'=>'坏货列表','returned_to_the_factory_and_warranty_returned_to_the_factory'=>'返厂列表','quality_return'=>'代管列表','test'=>'测试品列表'
                                ],
    'barcode_associatedss'=>[
        '1' => 'procurement', '2' => 'test','3' => 'sell', '4' => 'loan_out','5' => 'stock_returns',
        '6' => 'new', '7' => 'good', '8' => 'bad','9' => 'breakage','10' => 'sell_return','11' => 'warranty_replacement',
        '12' => 'quality_acceptance','13' => 'loan_out_to_replace','14' => 'returned_to_the_factory','15' => 'factory_return',
        '16' => 'warranty_returned_to_the_factory','17' => 'quality_take_away','18' => 'escrow_to_storage','19' => 'test_return',
        '20' => 'test_to_procurement','22' => 'product_replacement','23' => 'loan_out_return', '24' => 'quality_return',
        '25' => 'borrow_to_sales','26'=>'models_to_replace'
    ],
    'barcode_associateds_type'=>[
        'procurement' => '采购', 'test' => '测试品','sell' => '销售', 'loan_out' => '借出','stock_returns' => '进货退货',
        'new' => '新品', 'good' => '良品', 'bad' => '坏货','breakage' => '报损','sell_return' => '销售退货','warranty_replacement' => '质保更换',
        'quality_acceptance' => '质保受理','loan_out_to_replace' => '借转更换','returned_to_the_factory' => '返厂在途','factory_return' => '返厂返回',
        'warranty_returned_to_the_factory' => '质保返厂','quality_take_away' => '质保取走','escrow_to_storage' => '代管转入库','test_return' => '测试品归还',
        'test_to_procurement' => '测试品转采购','product_replacement' => '产品更换','loan_out_return' => '借出还回', 'quality_return' => '质保返回',
        'borrow_to_sales' => '借转销售','models_to_replace'=>'型号更换'
    ],
    /*******************************条码关联状态END************************************/
    'WASO'=>[
        'danwei'=>'成都网烁信息科技有限公司',
        'zhanghao'=>'7411 8101 8220 0099 501',
        'kaihuhang'=>'中信银行成都人民南路支行',
        'shuihao'=>'915101076909194519',
        'dizhi'=>'成都市高新区高朋东路2号搏润科技园101',
        'dianhua'=>'028-62751968'
    ],
    'CDSL'=>[
        'danwei'=>'成都兴圣力科技有限公司',
        'zhanghao'=>'5100 1436 3370 5150 0742',
        'kaihuhang'=>'建设银行成都南虹支行',
        'shuihao'=>'91510107782669840G',
        'dizhi'=>'成都市高新区高朋东路2号搏润科技园101',
        'dianhua'=>'028-62751968'
    ],
    'SDDZ'=>[
        'danwei'=>'深度定制科技（成都）有限公司',
        'zhanghao'=>'1001 3000 0059 5288',
        'kaihuhang'=>'成都银行科技支行',
        'shuihao'=>'91510100MA6C5MMF9N',
        'dizhi'=>'成都市高新区高朋东路2号搏润科技园101',
        'dianhua'=>'028-62751968'
    ],

];