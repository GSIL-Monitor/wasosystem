
<?php $__env->startSection('css'); ?>
    <style>
        .listBox::after{content:"."; height:0; visibility:hidden; clear:both; display:block;}
        .tableL, .tableR {
            float: left;
        }
        .tableR{margin-left:10px;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(function () {
            $(document).on('click','.set_config',function () {
                var order_id="<?php echo e($out_order->id); ?>";
                var out_id=$(this).attr('data-id');
               axios.put("/waso/warehouse_out_managements/"+out_id,{
                   "_method":"PUT",
                   "_token":getToken(),
                   "order_id":order_id,
                   "type":"inventory_machine"
               }).then(function (response) {
                   toastrMessage('success',response.data.info,'top')
               }).catch(function (err) {
                   if(err.response.data.info){
                       toastrMessage('error',err.response.data.info)
                   }
               })
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <div class="JJList">
                <div class="listBox">
                <div class="tableL">
                    <table class="listTable">
                        <tbody>
                        <tr>
                            <th>产品</th>
                            <th>配件</th>
                            <th>数量</th>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo e($out_order->serial_number); ?>-------&gt;    <?php echo e($out_order->machine_model); ?>

                            </td>
                        </tr>
                        <?php $__currentLoopData = $out_order->order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->product->title); ?></td>
                            <td><?php echo e($item->name); ?></td>
                            <td>
                                <?php echo e($item->pivot->product_good_num); ?>

                            </td>
                        </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="tableR">
                    <table class="listTable">
                        <tbody>
                        <tr class="first">
                            <th>产品</th>
                            <th>配件</th>
                            <th>数量</th>
                        </tr>

                        <?php $__currentLoopData = $inventory_machine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="3"><?php echo e($item->order->serial_number); ?>-------&gt;         <?php echo e($item->order->machine_model); ?>

                                                                  <a class="set_config" data-id="<?php echo e($item->id); ?>">选用这个配置</a>
                            </td>
                        </tr>
                        <?php $__currentLoopData = $item->order->order_product_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item2->product->title); ?></td>
                                <td><?php echo e($item2->name); ?></td>
                                <td>
                                    <?php echo e($item2->pivot->product_good_num); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>