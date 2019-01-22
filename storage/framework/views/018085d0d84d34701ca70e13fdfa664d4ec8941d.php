
<?php $__env->startSection('js'); ?>
    <script>
        function pay(serial_number,price,type) {
            axios.post("<?php echo e(route('admin.funds_managements.pay')); ?>", {
                "_token": getToken(),
                "user_id": "<?php echo e($user->id); ?>",
                "type": type,
                "serial_number": serial_number,
                "price": price
            }).then(function (response) {
                toastrMessage('success', '付款成功')
            })
                .catch(function (err) {
                    toastrMessage('error', '付款失败')
                });
        }
        $(function () {
            $(document).on('click', '.deposit', function () {
                var Internal_funds = parseInt($('.Internal_funds').text());
                var non_payment = parseInt($('.non-payment').text())
                swal({
                    title: '存入金额',
                    width: 700,
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '存入金额！',
                    cancelButtonText: '取消',
                    html: '<div class="deposit_form"><form>存入金额：<input type="text" class="OneNumber" name="price" placeholder="请输入金额"  id="price"><br/>' + '信息备注：<input type="text" name="comment" placeholder="请输入备注信息"  id="comment"><br/></form></div>'
                    , preConfirm: function () {
                        return new Promise(function (resolve) {
                            resolve([
                                $('#price').val(),
                                $('#comment').val(),
                            ])
                        })
                    },
                    onOpen: function () {
                        $('#price').focus()
                    }
                }).then(function (result) {
                    if(parseInt($('#price').val()) > non_payment){
                        warning('存入金额必须小于等于未付金额','');
                        return false;
                    }
                    var form = $('.deposit_form form').fixedSerialize();
                    location.href = "<?php echo e(route('admin.funds_managements.deposit')); ?>?user_id=<?php echo e($user->id); ?>&" + form
                }).catch(swal.noop)
            });
            $(document).on('click', '.pay', function () {
                var type = $(this).attr('data-type');
                var price = 0;
                var Internal_funds = parseInt($('.Internal_funds').text());
                var serial_number = [];
                if (type == 'pay') {
                    $('.selectIds').each(function () {
                        if ($(this).prop('checked')) {
                            var pay = $(this).parent().siblings(".pays").find('.pay');
                            serial_number.push(pay.attr('serial_number'));
                            price += parseInt(pay.attr('price'))
                        }
                    });
                    if (serial_number.length <= 0) {
                        warning('你需要选择付款订单','');
                        return false;
                    }
                    if(Internal_funds < price){
                        warning('站内空资金不足,还差'+(price-Internal_funds)+'元');
                        return false;
                    }else{
                        pay(serial_number,price,type)
                    }
                } else {
                    var serial_n=$(this).attr('serial_number');
                    var prices = parseInt($(this).attr('price'));
                    swal({
                        title: "请输入定金金额" ,
                        input: 'number',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "支付定金" ,
                        cancelButtonText: '取消',
                        inputValidator: function (value) {
                            return new Promise(function (resolve, reject) {
                                if (value) {
                                    resolve()
                                } else {
                                    reject('你需要输入定金金额')
                                }
                            })
                        }
                    }).then(function (price) {
                        if(price > prices || price > Internal_funds){
                            warning('输入金额大于站内资金,或者大于该订单未支付金额！');
                            return false;
                        }else{
                            serial_number.push(serial_n)
                            if(price == prices){
                                pay(serial_number,price,'pay')
                            }else{
                                pay(serial_number,price,type)
                            }
                        }
                    })
                }

            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="Btn pay" data-type="pay">批量付款</button>
                <button class="Btn deposit">存入金额</button>
                <button class="changeWebClose Btn">返回</button>

            </div>
            <?php echo $__env->make('admin.common._search',
             ['placeholder'=>'请输入欠款订单号',
             'url'=>route('admin.funds_managements.create').'?user_id='.$user->id,
              'status'=>array_except(Request::all(),['type','keyword','_token','page']),
             ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="phoneBtnOpen"></div>
            <div class="PageBtnTxt">
              <div><?php echo e($user->username); ?> <?php echo e($user->nickname); ?></div>
              <div>站内可用：<span class="Internal_funds"><?php echo e($Internal_funds); ?></span> / 未付款：<span class="non-payment"><?php echo e($orders->sum('total_prices')); ?></span></div>
            </div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.funds_managements.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>