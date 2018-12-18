<li <?php echo $vue ?? ''; ?>>
    <div class="liLeft"><?php echo e($title); ?>：</div>
    <div class="liRight">
        <?php echo Form::text($field,$field_val ?? old($field),array_merge(['placeholder'=>$title],$other)); ?>

    </div>
    <div class="clear"></div>
</li>