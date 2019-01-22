<div id="C_body">

    <div class="loadPage" id="yuanhome" sys="yuan"><iframe frameborder="no" name="home" src=""></iframe></div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("barcode system")): ?>
                <div class="loadPage" id="tiaohome" sys="tiao"><iframe frameborder="no" name="home" src="<?php echo e(route('admin.tiao')); ?>"></iframe></div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("website system")): ?>
                <div class="loadPage" id="webhome" sys="web"><iframe frameborder="no" name="home" src="<?php echo e(route('admin.home')); ?>"></iframe></div>
        <?php endif; ?>
</div>