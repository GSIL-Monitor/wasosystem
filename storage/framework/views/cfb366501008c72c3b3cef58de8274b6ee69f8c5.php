<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta HTTP-EQUIV="pragma" CONTENT="no-cache">
    <meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
    <meta HTTP-EQUIV="expires" CONTENT="0">
    <title><?php echo $__env->yieldContent('title','网烁动态'); ?>-网烁信息科技有限公司</title>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords','keywords'); ?>"/>
    <meta name="description" content="<?php echo $__env->yieldContent('description','description'); ?>"/>

    <?php echo $__env->yieldContent('meta'); ?>
    
    <?php echo $__env->make('site.layouts.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('site.layouts.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body <?php if(auth()->guard('user')->guest()): ?>onselectstart="return false" CloseOpen  <?php endif; ?>>

<?php echo $__env->make('site.news.layouts.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('site.news.layouts.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('js'); ?>
<script>
    $(function () {
        $("img.lazy").lazyload({effect: "fadeIn"});
        /*  登录显示*/
        $('#news_header .user').mouseenter(function(){
            $('.user_box').slideDown(200);
        });
        $('#news_header .user').mouseleave(function(){
            $('.user_box').stop().slideUp(200);
        });

        /*    搜索框变化  */
        $(document).on("focus","#news_header .search_box .searchBorder input",function(){
            $(this).siblings("i").hide();
        });

        $(document).on("blur","#news_header .search_box .searchBorder input",function(){
            var val = $(this).val();
            if(val==""||val==" "){
                $(this).siblings("i").show();
            }
        });

        $(document).on("click","#news_header .search_box .searchBorder span",function(){
            var val = $(this).siblings("input").val();
            var reval = $(this).siblings("i").text();
            if(val==""||val==" "){
                val = reval;
            }
            location.href="/Search.html?key="+val;
        });
    });
</script>
</body>
</html>
