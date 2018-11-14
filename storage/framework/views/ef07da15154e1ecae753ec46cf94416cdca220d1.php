<div class="tips">
    <p>指数由硬盘容量、类型、级别、速度综合参数排序，指数越大性价比越高！也可根据关心参数点击排序。</p>
</div>

<table class="listTable">
    <tr class="tableTh">
        <th class="tableInfoDel tablePhoneShow">
            <div class="thTxt">排序</div>
        </th>
        <th class="tableName tableInfoDel">
            <div class="thTxt">产品规格</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="jiancheng,asc"></i>
                <i class="ZtoA" good="cpu" order="jiancheng,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">类别</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="framework_name,asc"></i>
                <i class="ZtoA" good="cpu" order="framework_name,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">转速</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="jie_kou_su_lv,asc"></i>
                <i class="ZtoA" good="cpu" order="jie_kou_su_lv,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">容量(G)</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="rong_liang,asc"></i>
                <i class="ZtoA" good="cpu" order="rong_liang,desc"></i>
            </div>
        </th>

        <th class="tableInfoDel tablePhoneShow activeTh">
            <div class="thTxt">指数</div>
            <div class="paiIcon">
                <i class="AtoZ" good="cpu" order="index,asc"></i>
                <i class="ZtoA active" good="cpu" order="index,desc"></i>
            </div>
        </th>
        <th>
            <div class="thTxt">变化</div>
            <div class="paiIcon"></div>
        </th>
    </tr>
   <?php $__currentLoopData = $hard_disk_lists['hard_disk_lists']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hard_disk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="tableXu tableInfoDel tablePhoneShow">
                <?php if($hard_disk->id == $hard_disk_lists['top']): ?>
                   <i class='tableTopXu'></i>
                   <?php else: ?>
                   <?php echo e($loop->iteration); ?>

                <?php endif; ?>
            </td>
            <td class="tableName"><?php echo e($hard_disk->jiancheng); ?></td>
            <td><?php echo e($hard_disk->framework_name); ?> / <?php echo e($hard_disk->series_name); ?></td>
            <td><?php echo e($hard_disk->jie_kou_su_lv); ?></td>
            <td><?php echo e($hard_disk->details['rong_liang']); ?>G</td>
            <td class="tableInfoDel tablePhoneShow "><?php echo e(round($hard_disk->index,2)); ?></td>
            <td>
                <?php switch($hard_disk->float):
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

