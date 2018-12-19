<?php

use GuzzleHttp\Client;
use Overtrue\Pinyin\Pinyin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/








Route::get('/intel.html',function () {return view('site.index.page')->with(['name'=>'Intel']);})->name('intel');
Route::get('/intelAD.html',function () {return view('site.index.page')->with(['name'=>'IntelAD']);})->name('intelAD');
Route::get('/asus.html',function () {return view('site.index.page')->with(['name'=>'Asus']);})->name('asus');
Route::get('/supermicro.html',function () {return view('site.index.page')->with(['name'=>'Supermicro']);})->name('supermicro');
//所有的前台路由
Route::get('downloadFile',function () {
    $File = public_path('storage/'.request()->input('file'));
    $time=today()->format('Y-m-d');
    $FileName= request()->input('name').$time.'.'.str_after(request()->input('file'),'.');
    return response()->download($File,$FileName);
});
Route::group(['namespace' => 'Web'], function ($router) {
    $router->get('/', 'IndexController@index'); //主页
    Route::group(['middleware' => ['wechat.oauth']], function ($router) {
        $router->get('wechat/auth',"RegisterController@wechat_auth");
        $router->get('account/setting',function(){
            return view('site.registers.wechat');
        })->name('account.setting');
        $router->get('account/bind',function(){
            return view('site.registers.wechat_bind');
        })->name('account.bind');
        $router->post('registers/wechat_store', 'RegisterController@wechat_store')->name('register.wechat_store'); //微信账号设置
        $router->post('registers/wechat_bind', 'RegisterController@wechat_bind')->name('register.wechat_bind'); //微信账号设置

    });
    $router->get('registers/check/{user}', 'RegisterController@check')->name('register.check'); //注册页
    $router->get('login', 'LoginController@showLoginForm')->name('login'); //登录页
    $router->post('login', 'LoginController@login')->name('site.login'); //登录
    $router->get('logout', 'LoginController@logout'); //退出登录
    $router->get('registers', 'RegisterController@index')->name('register'); //注册页
    $router->post('registers/create', 'RegisterController@store')->name('register.create'); //注册页

    $router->get('reset_password', 'ResetPasswordController@index')->name('reset_password.index'); //找回密码
    $router->post('reset_password/reset', 'ResetPasswordController@reset')->name('reset_password.reset'); //找回密码
    $router->get('search', 'SearchController@index')->name('search'); //搜索
    /*-----------------------------快速选型-----------------------------*/
    $router->get('Three_easy.html', 'ModelSelectionController@three_major_items')->name('three_major_items'); //三大件指数表
    $router->post('three_major_items/order', 'ModelSelectionController@order')->name('three_major_items.order'); //三大件指数表
    $router->get('Server_easy.html', 'ModelSelectionController@server_selection')->name('server_selection'); //服务器、存储选型
    $router->post('server_selection/filter', 'ModelSelectionController@filter')->name('server_selection.filter'); //服务器、存储选型
    $router->get('Designer_easy.html', 'ModelSelectionController@designer_selection')->name('designer_selection'); //图形工作站及设计师电脑选型
    $router->post('server_selection/designer_filter', 'ModelSelectionController@designer_filter')->name('designer_selection.designer_filter'); //服务器、存储选型
    /*-----------------------------深度定制-----------------------------*/
    $router->get('deep.html', 'InDepthCustomizationController@index')->name('in_depth_customization'); //深度定制
    /*-----------------------------解决方案-----------------------------*/
    $router->get('solution.html', 'SolutionController@index')->name('solution'); //解决方案
    $router->get('solutionif_{integration}.html', 'SolutionController@show')->name('solution.show'); //解决方案详情
    /*-----------------------------IT外包-----------------------------*/
    $router->get('IT_easy.html', 'ItOutsourcingController@index')->name('it_outsourcing'); //
    $router->post('it_outsourcing/{product_good}/save', 'ItOutsourcingController@save')->name('it_outsourcing.save'); //
    /*-----------------------------关于我们-----------------------------*/
    $router->get('About/about.html', 'AboutController@about')->name('about'); //关于我们
    $router->get('About/qualified.html', 'AboutController@honor')->name('honor'); //荣誉资质
    $router->get('About/contact.html', 'AboutController@contact')->name('contact'); //联系我们
    /*-----------------------------新闻资讯-----------------------------*/
    $router->get('news_gongsi.html', 'NewsController@index'); //新闻列表
    $router->get('news_jishu.html', 'NewsController@index'); //新闻列表
    $router->get('news_hangye.html', 'NewsController@index'); //新闻列表
    $router->get('news_{information_management}.html', 'NewsController@show')->name('news.show'); //新闻详情
    /*-----------------------------加入我们-----------------------------*/
    $router->get('Job/job.html', 'JobController@index')->name('job.index');
    $router->get('job_info_{job}.html', 'JobController@show')->name('job.show');
    /*-----------------------------服务支持-----------------------------*/
    $router->get('Support/support.html', 'ServiceSupportController@index')->name('service_support.index');
    $router->get('support_{service_clause}.html', 'ServiceSupportController@service_clause')->name('service_support.service_clause');
    $router->get('service_clause_{service_clause}.html', 'ServiceSupportController@service_clause_phone')->name('service_support.service_clause_phone');
    $router->get('Copyright/copyright.html', 'ServiceSupportController@copyright')->name('service_support.copyright');
    $router->get('Feedback/feedback.html', 'ServiceSupportController@feedback')->name('service_support.feedback');
    $router->post('feedback/feedback_save', 'ServiceSupportController@feedback_save')->name('service_support.feedback_save');
    $router->get('Online/online.html', 'ServiceSupportController@online')->name('service_support.online');
    /*-----------------------------整机-----------------------------*/
    $router->get('server_{complete_machine_framework}.html', array('as' => 'server.index', 'uses' =>
        'ServerController@index'))->where(['complete_machine_framework' => '^((?!info_).)*$']);
    $router->get('server_info_{complete_machine}.html', 'ServerController@show')->name('server.show');
    $router->get('designer_info_{complete_machine}.html', 'ServerController@show')->name('server.designer');
    $router->post('server_search_{server}.html', 'ServerController@search')->name('server.search');
    $router->get('completeMachine/{complete_machine}/collect', 'ServerController@collect')->name('server.collect');
    $router->get('completeMachine/{complete_machine}/collectRemove', 'ServerController@collectRemove')->name('server.collectRemove');
    $router->get('completeMachine/{complete_machine}/comparison', 'ServerController@comparison')->name('server.comparison');
    $router->get('completeMachine/{complete_machine}/comparisonRemove', 'ServerController@comparisonRemove')->name('server.comparisonRemove');
    $router->get('completeMachine/comparisonAllRemove', 'ServerController@comparisonAllRemove')->name('server.comparisonAllRemove');
    $router->get('completeMachine/comparisonShow', 'ServerController@comparisonShow')->name('server.comparisonShow');
    $router->post('completeMachine/add_or_delete', 'ServerController@add_or_delete')->name('server.add_or_delete');
    $router->get('completeMachine/{complete_machine}/reset', 'ServerController@reset')->name('server.reset');
    $router->post('completeMachine/save', 'ServerController@save')->name('server.save');

    /*-----------------------------驱动下载-----------------------------*/
    $router->get('Download/download_server.html', 'DriveController@index')->name('drive.index');
    $router->get('download_server_{complete_machine}.html', 'DriveController@show')->name('drive.show');
    /*-----------------------------绑定授权管理-----------------------------*/
    $router->post('binding_authorization/send', 'BindingAuthorizationController@send')->name('binding_authorization.send');
    $router->post('binding_authorization/check_code', 'BindingAuthorizationController@checkCode')->name('binding_authorization.check_code');
    $router->post('binding_authorization/check_number', 'BindingAuthorizationController@checkNumber')->name('binding_authorization.check_number');
//
    $router->group(['middleware'=>'auth.user:user'], function ($router) {

        $router->get('member_center', 'MemberCenterController@index')->name('member_center');
        $router->get('notifications', 'NotificationsController@index')->name('notifications.index');
        $router->get('notifications/{notification}/read', 'NotificationsController@read')->name('notifications.read');
        $router->post('member_center/parts_buy/get_product', 'PartsController@get_product')->name('parts_buy.get_product');
        $router->resource('parts_buy', 'PartsController', ['only' => ['index','update', 'store','destroy']]);//配件选购
        $router->post('orders/copy/{order}', 'OrdersController@copy')->name('orders.copy');//订单物料的添加修改
        $router->get('orders/{order}/reset', 'OrdersController@reset')->name('order.reset');
        $router->post('orders/{order}/save', 'OrdersController@save')->name('order.save');
        $router->post('orders/add_common_equipment/{order}', 'OrdersController@add_common_equipment')->name('orders.add_common_equipment');//常用配置
        $router->resource('orders', 'OrdersController', ['only' => ['index','update','show','edit', 'store','destroy']]);//我的订单
        /*-----------------------------常用配置管理-----------------------------*/

        $router->post('common_equipments/add_modified_temporary_materials/{common_equipment}', 'CommonEquipmentController@add_modified_temporary_materials')->name('common_equipments.add_modified_temporary_materials');//订单物料的添加修改
        $router->post('common_equipments/update_prices', 'CommonEquipmentController@update_prices')->name('common_equipments.update_prices');//配置金额修改
        $router->get('common_equipments/{common_equipment}/reset', 'CommonEquipmentController@reset')->name('common_equipments.reset');
        $router->post('common_equipments/{common_equipment}/save', 'CommonEquipmentController@save')->name('common_equipments.save');
        $router->resource('common_equipments', 'CommonEquipmentController', ['only' => ['index', 'store', 'update', 'edit', 'show', 'destroy']]);

        /*-----------------------------资金管理-----------------------------*/
        $router->resource('funds_managements', 'FundsManagementController', ['only' => ['index']]);
        /*-----------------------------我的收藏-----------------------------*/
        $router->resource('collect', 'CollectController', ['only' => ['index']]);

        /*-----------------------------个人信息-----------------------------*/
        $router->get('personal_details/password_edit', 'PersonalDetailsController@create')->name('personal_details.password_edit');
        $router->resource('personal_details', 'PersonalDetailsController', ['only' => ['index','update']]);
        /*-----------------------------会员物流地址管理-----------------------------*/
        $router->resource('user_addresses', 'UserAddressController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
        /*-----------------------------会员单位管理-----------------------------*/
        $router->resource('user_companies', 'UserCompanyController', ['only' => ['index', 'store', 'update', 'edit', 'destroy']]);
        /*-----------------------------绑定授权管理-----------------------------*/
        $router->get('binding_authorization', 'BindingAuthorizationController@index')->name('binding_authorization.index');
        $router->post('binding_authorization/bind', 'BindingAuthorizationController@bind')->name('binding_authorization.bind');
        $router->post('binding_authorization/user/check_password', 'BindingAuthorizationController@check_password')->name('binding_authorization.check_password');
    });
});
//所有的后台路由
Route::group(['namespace' => 'Admin', 'prefix' => 'waso', 'as' => 'admin.', 'middleware' => ['operation.log'],], function ($router) {
    $router->get('/', 'IndexController@index')->name('waso'); //主页
    $router->get('home', 'IndexController@home')->name('home'); //网站系统首页

    /**********统计***********/
    $router->get('all_data_chart','IndexController@allData'); //主页
    $router->get('user_chart','IndexController@userCount'); //主页
    $router->get('self_user_chart','IndexController@selfUserCount'); //主页
    $router->get('order_chart','IndexController@orderCount'); //主页
    $router->get('self_order_chart','IndexController@selfOrderCount'); //主页
    $router->get('order_price_chart','IndexController@orderPriceChart'); //主页
    $router->get('self_order_price_chart','IndexController@selfOrderPriceChart'); //主页
    $router->get('product_goods_chart','IndexController@productGoods'); //主页
    $router->get('articles_chart','IndexController@articles'); //主页

    $router->get('supplie_chart','CodeController@supplie_chart'); //主页
    $router->get('procurement_plans_chart','CodeController@procurement_plans_chart'); //主页
    $router->get('out_chart','CodeController@out_chart'); //主页
    $router->get('inventory_chart','CodeController@inventory_chart'); //主页

    /*********************/



    $router->get('tiao', 'IndexController@tiao')->name('tiao'); //条码系统首页
    /*登录*/
    $router->get('login', 'LoginController@showLoginForm')->name('login'); //登录页
    $router->post('login', 'LoginController@login'); //登录
    $router->get('logout', 'LoginController@logout'); //退出登录
    /*登录END*/
    $router->get('waso/waso-log-viewer', 'AdminsController@log_viewer')->name('log-viewer'); //管理员
    $router->resource('admins', 'AdminsController'); //管理员
    $router->resource('menus', 'MenusController');//菜单栏
    $router->resource('roles', 'RoleController');//角色管理
    $router->resource('permissions', 'PermissionController');//权限管理

    $router->resource('products', 'ProductController');//配件

    $router->post('product_paramenters/get_paramenters', 'ProductParamenterController@get_paramenters')->name('get_paramenters');//获取专有项
    $router->resource('product_paramenters', 'ProductParamenterController');//配件专有项
    $router->resource('product_frameworks', 'ProductFrameworkController');//配件架构
    $router->resource('product_drives', 'ProductDriveController', ['only' => [ 'destroy']]);
    $router->post('product_goods/getseries', 'ProductGoodController@getseries')->name('product_goods.getseries');//配件产品
    $router->get('product_goods/updatePrices', 'ProductGoodController@updatePrices')->name('product_goods.updatePrices');//配件产品价格修改

    $router->get('product_goods_drive/{product_good}', 'ProductGoodController@drive')->name('product_goods.drive');//配件驱动列表
    $router->put('product_goods_drive_add/{product_good}', 'ProductGoodController@drive_add')->name('product_goods.drive_add');//配件驱动添加
    $router->post('product_goods_copy/{product_good}', 'ProductGoodController@copy')->name('product_goods.copy');//产品复制
    $router->resource('self_build_terraces', 'SelfBuildTerraceController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);//自建平台
    $router->resource('product_goods', 'ProductGoodController');//配件产品

    $router->resource('complete_machine_frameworks', 'CompleteMachineFrameworksController');//整机参数分类
    $router->resource('complete_machines', 'CompleteMachineController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);//整机
    $router->resource('it_services', 'ItServiceController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);//IT服务
    $router->resource('integration_categories', 'IntegrationCategoryController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);//软硬一体化分类
    $router->resource('integrations', 'IntegrationController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);//软硬一体化
    /*-----------------------------会员状态管理-----------------------------*/
    $router->resource('member_statuses', 'MemberStatusController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

    /*-----------------------------会员管理-----------------------------*/

    $router->resource('users', 'UserController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    /*-----------------------------会员物流地址管理-----------------------------*/
    $router->resource('user_addresses', 'UserAddressController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    /*-----------------------------会员单位管理-----------------------------*/
    $router->resource('user_companies', 'UserCompanyController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    /*-----------------------------旧网站订单管理-----------------------------*/
    $router->resource('old_orders', 'OldOrderController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    /*-----------------------------客情管理-----------------------------*/
    $router->resource('visitor_details', 'VisitorDetailController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    /*-----------------------------订单管理-----------------------------*/

    $router->get('orders/search', 'OrderController@search')->name('orders.search');//
    $router->post('orders/orders_for_the_transfer/{order}', 'OrderController@orders_for_the_transfer')->name('orders.orders_for_the_transfer');//常用配置
    $router->post('orders/add_common_equipment/{order}', 'OrderController@add_common_equipment')->name('orders.add_common_equipment');//常用配置
    $router->get('orders/export/{order}', 'OrderController@export')->name('orders.export');//订单表格导出
    $router->post('orders/add_modified_temporary_materials/{order}', 'OrderController@add_modified_temporary_materials')->name('orders.add_modified_temporary_materials');//订单物料的添加修改
    $router->post('orders/copy/{order}', 'OrderController@copy')->name('orders.copy');//订单物料的添加修改
    $router->resource('orders', 'OrderController', ['only' => ['index', 'create', 'show', 'store', 'update', 'edit', 'destroy']]);


    /*-----------------------------常用配置管理-----------------------------*/

    $router->get('common_equipments/place_an_order/{common_equipment}', 'CommonEquipmentController@place_an_order')->name('common_equipments.place_an_order');//订单物料的添加修改
    $router->post('common_equipments/add_modified_temporary_materials/{common_equipment}', 'CommonEquipmentController@add_modified_temporary_materials')->name('common_equipments.add_modified_temporary_materials');//订单物料的添加修改
    $router->post('common_equipments/update_prices', 'CommonEquipmentController@update_prices')->name('common_equipments.update_prices');//配置金额修改
    $router->resource('common_equipments', 'CommonEquipmentController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'show', 'destroy']]);

    /*-----------------------------需求管理-----------------------------*/
    $router->post('demand_managements/add_modified_temporary_materials/{demand_management}', 'DemandManagementController@add_modified_temporary_materials')->name('demand_managements.add_modified_temporary_materials');//订单物料的添加修改
    $router->post('demand_managements/get_complete_machine', 'DemandManagementController@get_complete_machine')->name('demand_managements.get_complete_machine');//订单物料的添加修改
    $router->post('demand_managements/filtrateList', 'DemandManagementController@filtrateList')->name('demand_managements.filtrateList');//订单物料的添加修改
    $router->resource('demand_managements', 'DemandManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'show', 'destroy']]);

    /*-----------------------------需求管理筛选-----------------------------*/
    $router->resource('demand_filtrates', 'DemandFiltrateController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

    /*-----------------------------部门管理-----------------------------*/
    $router->resource('divisional_managements', 'DivisionalManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
    $router->resource('marketing_statistics', 'MarketingStatisticsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

    /*-----------------------------销售任务管理-----------------------------*/


    $router->get('task_managements/marketing_statistics', 'TaskManagementController@marketing_statistics')->name('task_managements.marketing_statistics');
    $router->get('task_managements/historical_task', 'TaskManagementController@historical_task')->name('task_managements.historical_task');
    $router->get('task_managements/task_progress', 'TaskManagementController@task_progress')->name('task_managements.task_progress');
    $router->resource('task_managements', 'TaskManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

    /*-----------------------------资金管理-----------------------------*/

    $router->post('funds_managements/pay', 'FundsManagementController@pay')->name('funds_managements.pay');
    $router->get('funds_managements/deposit', 'FundsManagementController@deposit')->name('funds_managements.deposit');
    $router->get('funds_managements/financial_details', 'FundsManagementController@financial_details')->name('funds_managements.financial_details');
    $router->resource('funds_managements', 'FundsManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);


    /*-----------------------------微信应用管理-----------------------------*/
    $router->post('we_chat_application_managements/create', 'WeChatApplicationManagementController@createAppChart')->name('we_chat_application_managements.createAppChart');
    $router->resource('we_chat_application_managements', 'WeChatApplicationManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'show', 'destroy']]);

   /*-----------------------------发送消息-----------------------------*/
   $router->resource('send_messages', 'SendMessageController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------企业管理-----------------------------*/
    $router->get('business_managements/about', 'BusinessManagementController@about')->name('business_managements.about');
    $router->get('business_managements/honor', 'BusinessManagementController@honor')->name('business_managements.honor');
    $router->get('business_managements/job', 'BusinessManagementController@job')->name('business_managements.job');
    $router->get('business_managements/copyright', 'BusinessManagementController@copyright')->name('business_managements.copyright');
    $router->get('business_managements/service_directory', 'BusinessManagementController@service_directory')->name('business_managements.service_directory');
    $router->get('business_managements/banner', 'BusinessManagementController@banner')->name('business_managements.banner');
    $router->get('business_managements/friend', 'BusinessManagementController@friend')->name('business_managements.friend');
   $router->resource('business_managements', 'BusinessManagementController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------资讯管理-----------------------------*/
   $router->resource('information_managements', 'InformationManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------设置-----------------------------*/
   $router->resource('settings', 'SettingsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------供应商管理-----------------------------*/
   $router->resource('supplier_managements', 'SupplierManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------供应商返修地址-----------------------------*/
   $router->resource('supplier_repair_addresses', 'SupplierRepairAddressController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------采购计划-----------------------------*/
    $router->post('procurement_plans/get_goods', 'ProcurementPlanController@get_goods')->name('procurement_plans.get_goods');
   $router->resource('procurement_plans', 'ProcurementPlanController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------入库管理-----------------------------*/
    $router->get('put_in_storage_managements/two_code/{put_in_storage_management}', 'PutInStorageManagementController@two_code')->name('put_in_storage_managements.two_code');
    $router->get('put_in_storage_managements/in_finish', 'PutInStorageManagementController@in_finish')->name('put_in_storage_managements.in_finish');
    $router->get('put_in_storage_managements/in_unfinished', 'PutInStorageManagementController@in_unfinished')->name('put_in_storage_managements.in_unfinished');
   $router->post('put_in_storage_managements/checkCode', 'PutInStorageManagementController@checkCode')->name('put_in_storage_managements.checkCode');
   $router->resource('put_in_storage_managements', 'PutInStorageManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------库存管理-----------------------------*/
   $router->resource('inventory_managements', 'InventoryManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------出库管理-----------------------------*/
    $router->post('warehouse_out_managements/checkCode', 'WarehouseOutManagementController@checkCode')->name('warehouse_out_managements.checkCode');

     $router->get('warehouse_out_managements/inventory_machine', 'WarehouseOutManagementController@inventory_machine')->name('warehouse_out_managements.inventory_machine');
    $router->get('warehouse_out_managements/code_out', 'WarehouseOutManagementController@code_out')->name('warehouse_out_managements.code_out');
    $router->get('warehouse_out_managements/out_order', 'WarehouseOutManagementController@out_order')->name('warehouse_out_managements.out_order');
   $router->resource('warehouse_out_managements', 'WarehouseOutManagementController', ['only' => ['index', 'create', 'store', 'update', 'edit','show', 'destroy']]);

   /*-----------------------------条码关联-----------------------------*/
   $router->get('barcodes/index', 'BarcodesController@index')->name('barcodes.index');//条码查询
   $router->resource('barcode_associateds', 'BarcodeAssociatedController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------建议反馈-----------------------------*/
   $router->resource('feed_backs', 'FeedBackController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------会员公告管理-----------------------------*/
   $router->resource('notifications', 'NotificationController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------视频管理-----------------------------*/
   $router->resource('videos', 'VideoController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);

   /*-----------------------------服务管理-----------------------------*/

   $router->get('services/{service}/export', 'ServiceController@export')->name('services.export');
   $router->get('services/repair_statistics', 'ServiceController@repair_statistics')->name('services.repair_statistics');
   $router->resource('services', 'ServiceController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
/*-*/ //不可删除



    $router->post('allUpdate', 'CommonConroller@allUpdate')->name('allupdate');//批量修改
    $router->post('upload/uploadFiles', 'UploadController@uploadFiles');//文件上传
    $router->post('upload/uploadImages', 'UploadController@uploadImages');//文件上传
    $router->delete('upload/uploadFileDelete', 'UploadController@uploadFilesDelete');//文件删除
});
$router->get('/comm', 'Admin\MigrationController@run');

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
