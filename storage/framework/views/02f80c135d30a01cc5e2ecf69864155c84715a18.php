
<?php $good = app('App\Presenters\ProductGoodParamenterPresenter'); ?>

<?php $__env->startSection('title',$completeMachine->name); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/product_info.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/product_info_edit.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/product.js')); ?>"></script>
    <script src="<?php echo e(asset('js/FixLinks.js')); ?>"></script>
    <script src="<?php echo e(asset('js/materialEditor.js')); ?>"></script>
    <script>
        $(function () {
            $(".news li:nth-child(3n)").addClass("last");
            qrcode();
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate()
        });
        var vm = new Vue({
            el: "#app",
            data:{
                total_price: '<?php echo $completeMachine->UnitPrice(); ?>',
                goodLists:[],
                <?php if($user_products->isNotEmpty()): ?>
                goodLists:<?php echo $good->get_goods($user_products); ?>,
                <?php endif; ?>
                raids :<?php echo json_encode($good->raids(),true); ?>

            },
            methods:{
                set_price(price){
                    this.total_price=price;
                },
                reset(){
                    var self=this;
                    var Notice=this.$Notice;
                    axios.get('<?php echo e(route('server.reset',$completeMachine->id)); ?>').then(function (response) {
                        self.$refs.child.goodList=response.data;
                        Notice.success(
                            {
                                title: "重置成功！",
                                duration: 1,
                                onClose: function () {
                                    zheng_JiXingHao_Create();
                                    ConfigurationCodeCreate()
                                    qrcode();
                                }
                            });
                    }).catch(function (error) {
                        swal(error.response.data.message,'','warning')
                    });
                },
                save(){
                    var self=this;
                    var Notice=this.$Notice;
                    var form_data=$('#completeMachine').fixedSerialize();
                    axios.post('<?php echo e(route('server.save')); ?>',form_data+'&_token='+getToken()).then(function (response) {
                        Notice.success(
                            {
                                title: "保存成功 正在跳转到意向订单！",
                                duration: 1,
                                onClose: function () {
                                    location.href='/orders/'+response.data
                                }
                            });
                    }).catch(function (error) {
                        swal(error.response.data.message,'','warning')
                    });
                }
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="softCopyRight">
        <img src="<?php echo e(asset('pic/softCopyright.jpg')); ?>">
        <span class="softCopyClose" title="关闭">×</span>
    </div>
    <div id="Pic_black"></div>
    <div id="P_buy">
        <div class="P_buy_now">
            <button class="editDetail <?php if(auth()->guard('user')->guest()): ?> noLogin <?php endif; ?>">基础配置修改</button>
            <button class="editDetail <?php if(auth()->guard('user')->guest()): ?> noLogin <?php endif; ?>">意向保存</button>
            <div class="clear"></div>
        </div>
    </div>

    <div class="pro_detail" id="app">
        <?php echo $__env->make('site.servers.info.material_editor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <div class="body">

        <div id="crumbs">
            <div class="wrap">
                <a href="/">首页</a> > 产品分类 >
                    <a class="P_backUrl" href="<?php echo e(route('server.index',$parent->id)); ?>"> <?php echo e($parent->name); ?> </a>
                > 网烁<?php echo e(str_before($completeMachine->name,'-')); ?> 基础配置
            </div>
        </div>


        <div class="wrap">
            <div class="buy_box">
                <?php if ($__env->exists('site.servers.info.pic')) echo $__env->make('site.servers.info.pic', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php if ($__env->exists('site.servers.info.titleTag')) echo $__env->make('site.servers.info.titleTag', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="clear"></div>
            </div>
            <!-- 上部图片及价格说明 结束 -->
        </div>


        <div class="info_down">
            <?php if ($__env->exists('site.servers.info.silder')) echo $__env->make('site.servers.info.silder', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


            <div class="detail_box">

                <?php if ($__env->exists('site.servers.info.video')) echo $__env->make('site.servers.info.video', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                <?php if ($__env->exists('site.servers.info.detail')) echo $__env->make('site.servers.info.detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- 规格参数 结束 -->

                    <?php if ($__env->exists('site.servers.info.news')) echo $__env->make('site.servers.info.news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



                <?php if ($__env->exists('site.servers.info.drive')) echo $__env->make('site.servers.info.drive', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- 相关下载 结束 -->


                <?php if ($__env->exists('site.servers.info.sales_record')) echo $__env->make('site.servers.info.sales_record', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- 销售记录 结束 -->


                <?php if ($__env->exists('site.servers.info.recommend')) echo $__env->make('site.servers.info.recommend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- 相关推荐 结束 -->

            </div>
            <!-- 商品详情 结束 -->


        </div>
    </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>