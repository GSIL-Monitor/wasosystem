<?php $DivisionalManagementParamenter = app('App\Presenters\DivisionalManagementParamenter'); ?>

    
    
        
            
                
                
            
            
        
    


    

<div class="bingBox">

    <div class="pieBigMode">
            <?php echo $DivisionalManagementParamenter->chart($divisional_managements,$parent_id,$year,$mouth); ?>

    </div>


    <ul class="pies">
        <?php echo $DivisionalManagementParamenter->PieBox($divisional_managements,$parent_id,$year,$mouth); ?>

    </ul>
</div>
<script>
    $(function () {
        /* 营销统计 li宽高  */
        function bindZhi(){
            var totalWidth = $(".bindLine").width();
            $('.bindBox li').each(function () {
                var num =parseInt($(this).find('.bindZhi').attr('data_num'));
                var liWidth = Math.floor(num / 100 * totalWidth) + "px";
                $(this).find(".zhi").text(num + "%");
                $(this).find(".lines").css("width",liWidth);
            });
        }
        bindZhi();
        $('.perCanvas').drawCanvasPercent();
    });
</script>
