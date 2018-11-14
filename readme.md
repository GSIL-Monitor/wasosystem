## 2018年3月21日对网烁管理系统进行重构

http://oomusou.io/laravel/laravel-architecture/Laravel 的中大型专案架构
http://oomusou.io/laravel/laravel-repository/如何使用 Repository 模式?
http://oomusou.io/laravel/laravel-service/如何使用 Service 模式?
http://oomusou.io/laravel/laravel-service/http:如何使用 Presenter 模式 ?
##别将我们的思维局限在MVC 内 :
Model :仅当成Eloquent class。
Repository :辅助model，处理资料库逻辑，然后注入到service。
Service :辅助controller，处理商业逻辑，然后注入到controller。
Controller :接收HTTP request，调用其他service。
Presenter :处理显示逻辑，然后注入到view。
View :使用blade将资料binding到HTML。
## 项目采用Laravel5.6 + Mysql + Composer +Linux 进行重构，重构后更具维护性和扩展性
```
需要用到的版本
PHP >=7.13  
Mysql 5.6
用到的扩展包
composer require --dev barryvdh/laravel-ide-helper 
composer require doctrine/dbal
composer require intervention/image
composer require mews/captcha
composer require spatie/laravel-permission
composer require "overtrue/pinyin:~3.0"
composer require kalnoy/nestedset
```
## 新建一个网烁项目
```
composer create-project laravel/laravel wasosystem --prefer-dist  "版本号"
```

```
  *需要弹出窗  按钮class="alertWeb" data_url="连接"     对应页面返回按钮 class="alertWebClose"
  *需要再开窗  按钮class="changeWeb" data_url="连接"  对应页面返回按钮 class="changeWebClose"
```
###创建商品表  
```
// 这个表里面是共用字段
$table->increments('id');
$table->integer('product_id')->unsigned()->index()->comment('产品id');
$table->integer('jiagou_id')->unsigned()->index()->comment('产品架构id');
$table->integer('xilie_id')->unsigned()->index()->comment('产品系列id');
$table->string('name')->index()->comment('产品名称');
$table->string('jiancheng')->nullable()->index()->comment('产品简称');
$table->string('jianma')->nullable()->index()->comment('产品简码');
$table->string('daima')->nullable()->comment('产品原厂代码');
$table->integer('lingshou')->unsigned()->index()->comment('产品零售价格');
$table->integer('huiyuan')->unsigned()->index()->comment('产品会员价格');
$table->integer('hezuo')->unsigned()->index()->comment('产品合作价格');
$table->integer('hexin')->unsigned()->index()->comment('产品核心价格');
$table->integer('chengben')->unsigned()->index()->comment('产品成本价格');
$table->integer('taobao')->unsigned()->index()->comment('产品淘宝价格');
$table->boolean('zhanshi')->nullable()->default(true)->comment('展示');
$table->boolean('zhuliu')->nullable()->comment('主流');
$table->boolean('tuijian')->nullable()->comment('推荐');
$table->boolean('tingchan')->nullable()->comment('停产');
$table->boolean('rexiao')->nullable()->comment('热销');
$table->boolean('yincang')->nullable()->comment('隐藏');
$table->integer('zhibaoshijian')->unsigned()->nullable()->index()->comment('产品质保时间');
$table->string('max_images')->nullable()->comment('产品原图');
$table->string('small_images')->nullable()->index()->comment('产品比列图');
$table->string('thumb_images')->nullable()-comment('产品缩略图');
$table->text('details')->nullable()->comment('产品的详细参数  这里我用json 保存');
$table->integer('oldid')->unsigned()->nullable()->index()->comment('旧数据产品id 做数据迁移的时候使用');
$table->foreign('product_id')
    ->references('id')->on('products')
    ->onDelete('cascade');//删除产品  则删除所有配件
$table->timestamps();
$table->softDeletes();
```



