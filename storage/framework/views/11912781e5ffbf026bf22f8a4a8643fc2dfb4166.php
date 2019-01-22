
<?php $good = app('App\Presenters\ProductGoodParamenterPresenter'); ?>
<?php $__env->startSection('title',$order->machine_model.'订单详情'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/order_info_public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/order.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/product_info_edit.css')); ?>" rel="stylesheet" type="text/css">
    <style>
        .ivu-btn-primary{color:#fff;background-color:#fff;border:none}
        .ivu-btn-primary:hover{color:#fff;background-color:#fff;border:none}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script type="text/javascript" src="<?php echo e(asset('js/picScroll.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/clipboard.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/shopcar.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/person.js')); ?>"></script>

    <script>
        var location_url='<?php echo e(route('orders.index')); ?>';
        $(function () {
            qrcode();
            zheng_JiXingHao_Create();
            ConfigurationCodeCreate()
        });

        var vm = new Vue({
            el: "#app",
            data:{
                total_price: '<?php echo $order->unit_price; ?>',
                goodLists:[],
                <?php if(optional($user_products)->isNotEmpty() && $order->order_type !='parts'): ?>
                goodLists:<?php echo $good->get_goods($user_products); ?>,
                <?php endif; ?>
                raids :<?php echo json_encode($good->raids(),true); ?>

            },
            methods:{
                set_price:function (price){
                    this.total_price=price;
                },
                reset:function () {
                    var self=this;
                    var Notice=this.$Notice;
                    axios.get('<?php echo e(route('order.reset',$order->id)); ?>').then(function (response) {
                        self.$refs.child.goodList=response.data;
                        self.total_price= '<?php echo $order->unit_price; ?>',
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
                save:function () {
                    var self=this;
                    var Notice=this.$Notice;
                    var form_data=$('#completeMachine').fixedSerialize();
                    axios.post('<?php echo e(route('order.save',$order->id)); ?>',form_data+'&_token='+getToken()).then(function (response) {
                        Notice.success(
                            {
                                title: "保存成功 正在刷新订单！",
                                duration: 1,
                                onClose: function () {
                                    location.reload()
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
    <?php if($order->order_status == 'intention_to_order'): ?>
        <?php echo $__env->make('member_centers.orders.form.intention', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('member_centers.orders.form.non_intention', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('member_centers.orders.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>