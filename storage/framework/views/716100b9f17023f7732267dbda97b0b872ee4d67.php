<div class="tips">
    <p>指数由内存的容量、频率、类型综合参数排序，指数越大性价比越高！也可根据关心参数点击排序。</p>
</div>

<table class="listTable">
    <tr class="tableTh">
        <th class="tableInfoDel tablePhoneShow">
            <div class="thTxt">排序</div>
        </th>
        <th class="tableName tableInfoDel">
            <div class="thTxt">产品规格</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="jiancheng,asc"></i>
                <i class="ZtoA" good="memory" order="jiancheng,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">类别</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="framework_name,asc"></i>
                <i class="ZtoA" good="memory" order="framework_name,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">频率(Hz)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="pin_lv,asc"></i>
                <i class="ZtoA" good="memory" order="pin_lv,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">容量(G)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="rong_liang,asc"></i>
                <i class="ZtoA" good="memory" order="rong_liang,desc"></i>
            </div>
        </th>

        <th class="tableInfoDel tablePhoneShow activeTh">
            <div class="thTxt">指数</div>
            <div class="paiIcon">
                <i class="AtoZ" good="memory" order="index,asc"></i>
                <i class="ZtoA active" good="memory" order="index,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">变化</div>
            <div class="paiIcon"></div>
        </th>
    </tr>
   <?php $__currentLoopData = $memory_lists['memory_lists']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $memory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="tableXu tableInfoDel tablePhoneShow">
                <?php if($memory->id == $memory_lists['top']): ?>
                   <i class='tableTopXu'></i>
                   <?php else: ?>
                   <?php echo e($loop->iteration); ?>

                <?php endif; ?>
            </td>
            <td class="tableName"><?php echo e($memory->jiancheng); ?></td>
            <td><?php echo e($memory->framework_name); ?></td>
            <td><?php echo e($memory->details['gong_zuo_pin_lv']); ?>Hz</td>
            <td><?php echo e($memory->details['rong_liang']); ?>G</td>
            <td class="tableInfoDel tablePhoneShow "><?php echo e(round($memory->index,2)); ?></td>
            <td>
                <?php switch($memory->float):
                    case ("come-up"): ?>
                    <i class="tableSitu goUp"></i>
                    <?php break; ?>
                    <?php case ("lower"): ?>
                    <i class="tableSitu goDown"></i>
                    <?php break; ?>
                    <?php default: ?>
                    <i class="tableSitu goHold"></i>
                <?php endswitch; ?>
            </td>
        </tr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

