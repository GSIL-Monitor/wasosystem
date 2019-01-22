<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=0,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="shortcut icon" href="__PUBLIC__/favicon.ico"/>
    
    
    
    <link rel="stylesheet" href="<?php echo e(asset('admin/common/backend.css')); ?>" type="text/css">
    
    
    
    <title>登录 —— 成都网烁信息科技有限公司OA系统</title>
    <!--[if  IE]>
    <div class="IEBlack"></div>
    <div class="IE">
        <div class="logo_bg">
            <a class="logo" href=""><img src="<?php echo e(asset('admin/pic/logo.png')); ?>"></a>
        </div>
        <div class="tips">
            <p>很抱歉，您目前的浏览器版本较低</p>
            <p>为了享受更好的浏览体验，建议您升级到更高或者使用谷歌，火狐等非IE核心的浏览器。</p>
        </div>
        <ul class="IELinks">
            <li><a target="_blank" href="http://www.maxthon.cn/"><span class="one"></span><h3>遨游浏览器</h3></a></li>
            <li><a target="_blank" href="http://ie.sogou.com/"><span class="two"></span><h3>搜狗浏览器</h3></a></li>
            <li><a target="_blank" href="http://www.firefox.com.cn/"><span class="thr"></span><h3>火狐浏览器</h3></a></li>
            <li><a target="_blank" href="http://browser.qq.com/?adtag=SEM1"><span class="four"></span><h3>QQ浏览器</h3></a></li>
            <li><a target="_blank" href="http://www.google.cn/chrome/"><span class="five"></span><h3>谷歌浏览器</h3></a></li>
            <li><a target="_blank" href="http://se.360.cn/index_main.html"><span class="six"></span><h3>360浏览器</h3></a></li>
            <div class="clear"></div>
        </ul>
        <div class="tipW">
            <p> QQ，UC，遨游，360等浏览器请使用"极速模式" 。</p>
            <p>（以上链接为第三方软件下载地址，与本公司无关，请自行选择下载。）</p>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            var LookHeight = $(window).height();
            var divHeight = $(".IE").height();
            var top  = (LookHeight - divHeight) /2 -30;
            $(".IE").css("top",top);
        });
    </script>
    <![endif]-->

</head>
<body>

<div class="bgPic">
    <div class="glass">
        <div class="loginBox">
            <div class="container">
                <div class="logo">
                    <img src="<?php echo e(asset('admin/pic/menu.png')); ?>">
                    <h5>网烁综合管理系统</h5>
                </div>

                <div class="login">
                     <?php echo e(Form::open(['route'=>'admin.login'])); ?>

                    <div class="Up radius"><input type="text" class="userName" name="account" placeholder="用户名" autocomplete="off"></div>
                    <div class="Mid radius"><input type="password" class="pwd" name="password" placeholder="密 码 " autocomplete="off"></div>
                    <div class="Down radius">
                        <input type="text" class="checkCode" name="captcha" id="code" placeholder="验证码" autocomplete="off">
                        <div class="checkPic"><img title="点击刷新" id="che_pic" src="<?php echo captcha_src('waso'); ?>" align="absbottom" onClick="this.src=this.src+'?'+Math.random()" style="cursor: pointer"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="error">错误信息</div>
                    <div class="rememberBox"><label for="remember"><input type="checkbox" id="remember" name="remember"  autocomplete="off">记住我</label></div>
                    <div class="loginNow"><b class="">登 录</b><img src="<?php echo e(asset('admin/pic/loading.gif')); ?>"></div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
            <div class="Loginfoot">Copyright © <span class="time"><?php echo e(date('Y',time())); ?></span></br>网烁信息科技有限公司 版权所有</div>
        </div>
    </div>



</div>
</body>
</html>
<script src="<?php echo e(asset('admin/common/backend.js')); ?>" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        /*  调整背景  */
        function Pic() {
            var windowH = $(document).height();
            var loginH = $(".loginBox").height();
            $(".bgPic").height(windowH);
            
            
                
            
                
            
        }
        $(window).resize(function () {
            Pic();
        });
        Pic();
        /*  检查表单有无空 */
        function checkNull() {
            var result = "no";
            $(".login input").each(function () {
                var values = $(this).val();
                if (values == "" || values == " ") {
                    result = "no";
                    return false;
                } else {
                    result = "yes";
                }
            });
            if (result == "no") {
                $('.loginNow').fadeOut(300);
            } else {
                $('.loginNow').fadeIn(300);
            }
        };
        $(document).on("keyup", ".login input", function () {
            checkNull();
        });
        $(document).on("blur", ".login input", function () {
            $(this).trigger("keyup");
        });


        $(document).on("click", '.loginNow', function () {
            $(".error").hide();
            $(this).children("img").show();
            $(this).children("b").text("");
            var formDate=$('.login form').fixedSerialize();
            console.log(formDate);
            axios.post(
                "<?php echo e(route('admin.login')); ?>",
                formDate)
                .then(function (response) {
                        location.href="<?php echo e(route('admin.waso')); ?>";

            }).catch(function (errors) {
                console.log(errors.response.data.errors);
                var error='';
                $.each(errors.response.data.errors, function (i, v) {
                error+= v[0] +'</br>';
                });
                $(".loginNow").children("img").hide();
                $(".loginNow").children("b").text("登 录");
                $(".checkPic img").trigger("click");
                $(".error").html(error).fadeIn(500);
            });
        });
        $(document).keypress(function(e) {
            // 回车键事件
            if(e.which == 13) {
                jQuery(".loginNow").click();
            }
        });
    });

</script>
