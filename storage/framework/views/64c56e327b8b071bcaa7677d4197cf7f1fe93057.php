<li <?php echo $vue ?? ''; ?>>
    <div class="liLeft"><?php echo e($title); ?>：</div>
    <div class="liRight">
        <?php echo Form::textarea($field,$field_val,$other); ?>

    </div>
    <div class="clear"></div>
</li>