
<?php $__env->startSection('js'); ?>
    <script>
        var vm = new Vue({
            el: "#app",
            data: {
                logo: {
                    pic:<?php echo getImages(setting($type.'_logo')); ?>,
                    url:"<?php echo $type; ?>_logo[url][]",
                    name:"<?php echo $type; ?>_logo[name][]",
                },
                custome_hotline: {
                    pic:<?php echo getImages(setting($type.'_custome_hotline')); ?>,
                    url:"<?php echo $type; ?>_custome_hotline[url][]",
                    name:"<?php echo $type; ?>_custome_hotline[name][]",
                },
                service_hotline: {
                    pic:<?php echo getImages(setting($type.'_service_hotline')); ?>,
                    url:"<?php echo $type; ?>_service_hotline[url][]",
                    name:"<?php echo $type; ?>_service_hotline[name][]",
                },
                wechat: {
                    pic:<?php echo getImages(setting($type.'_wechat')); ?>,
                    url:"<?php echo $type; ?>_wechat[url][]",
                    name:"<?php echo $type; ?>_wechat[name][]",
                },
                intel: {
                    pic:<?php echo getImages(setting($type.'_intel')); ?>,
                    url:"<?php echo $type; ?>_intel[url][]",
                    name:"<?php echo $type; ?>_intel[name][]",
                },
                intelAD: {
                    pic:<?php echo getImages(setting($type.'_intelAD')); ?>,
                    url:"<?php echo $type; ?>_intelAD[url][]",
                    name:"<?php echo $type; ?>_intelAD[name][]",
                },
                asus: {
                    pic:<?php echo getImages(setting($type.'_asus')); ?>,
                    url:"<?php echo $type; ?>_asus[url][]",
                    name:"<?php echo $type; ?>_asus[name][]",
                },
                supermicro: {
                    pic:<?php echo getImages(setting($type.'_supermicro')); ?>,
                    url:"<?php echo $type; ?>_supermicro[url][]",
                    name:"<?php echo $type; ?>_supermicro[name][]",
                },
                members_base: {
                    pic:<?php echo getImages(setting($type.'_members_base')); ?>,
                    url:"<?php echo $type; ?>_members_base[url][]",
                    name:"<?php echo $type; ?>_members_base[name][]",
                },
                committeeman: {
                    pic:<?php echo getImages(setting($type.'_committeeman')); ?>,
                    url:"<?php echo $type; ?>_committeeman[url][]",
                    name:"<?php echo $type; ?>_committeeman[name][]",
                },
                soem: {
                    pic:<?php echo getImages(setting($type.'_soem')); ?>,
                    url:"<?php echo $type; ?>_soem[url][]",
                    name:"<?php echo $type; ?>_soem[name][]",
                },
                stap: {
                    pic:<?php echo getImages(setting($type.'_stap')); ?>,
                    url:"<?php echo $type; ?>_stap[url][]",
                    name:"<?php echo $type; ?>_stap[name][]",
                },
                actionImageUrl: "<?php echo env('ActionImageUrl'); ?>",
                imageUrl: "<?php echo env('IMAGES_URL'); ?>",
                deleteImageUrl: "<?php echo env('DeleteImageUrl'); ?>",
                fileCount:1,
            },
            methods: {
            },
            mounted: function () {
            },
        });
    </script>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit settings')): ?>
                    <button  class="Btn blue common_update" form_id="AllEdit">更新</button>
                <?php endif; ?>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <?php echo $__env->make('admin.common._lookType',['datas'=>config('status.settings'),'duiBiCanShu'=>$type,'url'=>route('admin.settings.index'),'canshu'=>'type'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="JJList ml-100" >
                <ul class="maxUl" id="app">
                    <form action="<?php echo e(route('admin.settings.store')); ?>" method="post" id="AllEdit" onsubmit="return false">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                         <?php if ($__env->exists('admin.settings.list.'.$type)) echo $__env->make('admin.settings.list.'.$type, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <div class="clear"></div>
                    </form>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>