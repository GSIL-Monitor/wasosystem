<script src="<?php echo e(asset('admin/js/order.js')); ?>"></script>
<script>
    new Vue({
        el: "#main",
        data:{
            
            options:[],
            orders_for_the_transfer_id:'',
            loading:false
        },
        methods: {
            orders_for_the_transfer() {
                var self=this;
                this.$Modal.confirm({
                    title: '请选择要订单过户的会员',
                    key: 'option',
                    align: 'center',
                    onOk: () => {
                        axios.post("<?php echo e(route('admin.orders.orders_for_the_transfer',$order->id)); ?>",{
                            "_token":getToken(),
                            'user_id': this.orders_for_the_transfer_id
                        }).then((response)=>{
                            toastrMessage('success', response.data.info, 'top')
                        }).catch((err)=>{
                            toastrMessage('error', '订单过户失败', 'static')
                        });
                    },
                    render: (h, params) => {
                        return h('Select', {
                                props:{
                                    loading:this.loading,
                                    filterable:true,
                                    transfer:true,
                                    clearable:true,
                                    remote:true,
                                    loadingText:'正在加载中..',
                                    remoteMethod:(query)=>{
                                        var self=this;
                                        if (query !== '') {
                                            this.loading = true;
                                            axios.get("<?php echo e(route('admin.orders.search')); ?>?username="+query)
                                                .then((response)=>{
                                                    self.loading = false;
                                                    self.options = response.data.filter(item => item.username.toLowerCase().indexOf(query.toLowerCase()) > -1);
                                                })
                                                .catch((err)=>{
                                                    self.options = [];
                                                });
                                        } else {
                                            this.options = [];
                                        }
                                    }
                                },
                                style:{
                                    border:'2px solid #eeeeee',
                                    margin:'0 0 5px 0'
                                },
                                on: {
                                    'on-change':(event) => {
                                        this.orders_for_the_transfer_id=event;
                                    }
                                },
                            },
                            this.options.map(function (item,index) {
                                return h('Option', {
                                    props: { value: item.id}
                                }, item.username);
                            })
                        );
                    },
                })
            },
        }
    });
    var vm = new Vue({
        el: "#app",
        data: {
            isDisabled:true,
            acceptance:true,
            skill:true,
            pack:true,
            order_status:'<?php echo e($order->order_status); ?>',
            <?php if(Route::is('admin.orders.create')): ?>
    defaultList: [],
        <?php else: ?>
    defaultList:<?php echo $order->pic; ?>,
    <?php endif; ?>
    actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
        imageUrl: "<?php echo env('IMAGES_URL'); ?>",
        deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
        fileCount:5,
    },
    methods: {
        orders_for_the_transfer () {
            this.$Modal.confirm({
                render: (h) => {
                    return h('Input', {
                        props: {
                            value: this.value,
                            autofocus: true,
                            placeholder: '请输入用户账号'
                        },
                        on: {
                            input: (val) => {
                                var url=$('.orders_for_the_transfer').attr('data_url');
                                console.log(url,val)
                            }
                        }
                    })
                }
            })
        },
        get_order_satus:function () {
            switch (this.order_status){
                case 'placing_orders':
                    this.acceptance=false;
                    this.skill=true;
                    this.pack=true;
                    break;
                case 'order_acceptance':
                    this.acceptance=false;
                    this.skill=true;
                    this.pack=true;
                    break;
                case 'in_transportation':
                    this.acceptance=false;
                    this.skill=false;
                    this.pack=false;
//                        this.set_order_satus_true();
                    break;
                case 'arrival _of_goods':
                    this.set_order_satus_true();
                    break;
                default :
                    this.set_order_satus_false();
            }
        },
        set_order_satus_true:function () {
            this.isDisabled=true;
            this.acceptance=true;
            this.skill=true;
            this.pack=true;
        },
        set_order_satus_false:function () {
            this.isDisabled=false;
            this.acceptance=false;
            this.skill=false;
            this.pack=false;
        },

    },
    mounted: function () {
    <?php switch($order->order_status):
    case ('intention_to_order'): ?>
        this.isDisabled=false;
    <?php break; ?>
    <?php case ('acceptance'): ?>
        this.acceptance=false;
    <?php break; ?>
    <?php case ('order_acceptance'): ?>
        this.acceptance=false;
        this.skill=false;
        this.pack=false;

    <?php break; ?>
    <?php endswitch; ?>

    },
    });

    $(function () {
    <?php if($order->order_type!='parts'): ?>
        zheng_JiXingHao_Create();
    <?php endif; ?>
        ConfigurationCodeCreate();
        qrcodeCreate();
        orderMaterialsTaxAndNotTax();
        $(document).on('change','.invoice_type ,.service_status',function () {
            orderTaxAndNotTax()
        })
        $(document).on('click','.contract_alert',function () {
            swal({
                title: '<?php echo e($order->serial_number); ?>合同模板',
                width: 700,
                allowOutsideClick:false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定下载！',
                cancelButtonText: '取消下载',
                html:'<?php echo $html; ?>'
                ,preConfirm: function () {
                    return new Promise(function (resolve) {
                        resolve([
                            $('#company').val(),
                            $('#des').val(),
                            $('.delivery_goods').val(),
                            $('.prompt').val(),
                            $('.service').val()
                        ])
                    })
                },
                onOpen: function () {
                    $('#company').focus()
                }
            }).then(function (result) {
                var form=$('.contract form').fixedSerialize();
                location.href="<?php echo e(route('admin.orders.export',$order->id)); ?>?view=<?php echo e($view); ?>&export=Contract&"+form
            }).catch(swal.noop)
        })
        $(document).on('click','.system_solution_alert',function () {

            var company='<?php echo e($company_name); ?> <?php echo e($order->user->nickname); ?>';
            var user_remark="<?php echo e(str_replace(array("\r\n", "\r", "\n"),'',$order->user_remark)); ?>";
            var company_remark="<?php echo e(str_replace(array("\r\n", "\r", "\n"),'',$order->company_remark)); ?>";
            swal({
                title: '<?php echo e($order->serial_number); ?>整机方案书',
                width: 700,
                allowOutsideClick:false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定下载！',
                cancelButtonText: '取消下载',
                html:'<div class="system_solution"><form>用户名称：<textarea name="username"  id="username">'+company+'</textarea><br/>'+'用户需求：<textarea id="des" name="des">'+user_remark+'</textarea><br/>'+'用户需求：<textarea id="des" name="des">'+company_remark+'</textarea><br/></form></div>'
                ,preConfirm: function () {
                    return new Promise(function (resolve) {
                        resolve([
                            $('#username').val(),
                            $('#des').val(),
                        ])
                    })
                },
                onOpen: function () {
                    $('#username').focus()
                }
            }).then(function (result) {
                var form=$('.system_solution form').fixedSerialize();
                location.href="<?php echo e(route('admin.orders.export',$order->id)); ?>?view=system_solution&export=SystemSolution&"+form
            }).catch(swal.noop)
        })

        $(document).on('click','.signature_form_alert',function () {
            swal({
                title: '请选择签收单模板类型！',
                text: '整机模式  OR   配件模式',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '整机模式！',
                cancelButtonText: '配件模式！',
            }).then(function(){
                location.href="<?php echo e(route('admin.orders.export',$order->id)); ?>?view=signature_form&export=SignatureForm&type=complete_machine";
            },function () {
                location.href="<?php echo e(route('admin.orders.export',$order->id)); ?>?view=signature_form&export=SignatureForm&type=parts";
            })
        })
        $(document).on('change','.order_num',function () {
            var num=parseInt($(this).val());
            var unit_price=parseInt($('.unit_price').val());
            $('.total_prices').val(num * unit_price);
        })
        $(document).on("click",".openTM",function(){
            $(this).removeClass("openTM").addClass("closeTM").text("隐藏条码").siblings(".TMBox").show();
        });
        $(document).on("click",".closeTM",function(){
            $(this).removeClass("closeTM").addClass("openTM").text("查看条码").siblings(".TMBox").hide();
        });
    })
</script>