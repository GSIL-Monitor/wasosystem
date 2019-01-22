<div class="my">
    <div class="phoneIndex">主页</div>
    <div class="myPic">

        <span><img src="<?php echo e(asset('admin/pic/logo.jpg')); ?>"/></span>
    </div>
    <div class="myName">
        <b class="titB"><?php echo e(auth('admin')->user()->name); ?>  <span class="infoIcon"></span></b>
        <div class="myControl">
            <a sys="web" class="geren2 links" name="geren2" pagelink="<?php echo e(route('admin.admins.edit',auth('admin')->user()->id)); ?>" href="javascript:;">密码修改</a>
            <a class="links" href="http://www.waso.com.cn/" target="_blank">公司官网</a>
            <a class="links" href="http://192.168.0.95:8080/" target="_blank">旧条码系统</a>
            <a class="takeOut" href="<?php echo e(url('/waso/logout')); ?>" target="_blank">安全退出</a>
        </div>
    </div>
    <div class="sys_links">
        <ul class="radiusBtn">
            <?php if($permissions->get('barcode system')): ?>
            <li sys="tiao"><a href="javascript:;"><i style="background:url(<?php echo e(asset('admin/pic/icons.png')); ?>) no-repeat 0 -240px;"></i><b>条码<em>系统</em></b></a></li>
            <?php endif; ?>
            <?php if($permissions->get('website system')): ?>
            <li class="active" sys="web"><a href="javascript:;"><i style="background:url(<?php echo e(asset('admin/pic/icons.png')); ?>) no-repeat 0 -220px;"></i><b>网站<em>系统</em></b></a></li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="clear"></div>
</div>