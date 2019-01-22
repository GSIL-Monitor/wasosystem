<li <?php echo $vue ?? ''; ?>>
    <div class="liLeft"><?php echo e($title); ?>：</div>
    <div class="liRight">
        <?php echo Form::select($field,$field_list,old($field),$other); ?>

    </div>
    <div class="clear"></div>
</li>