<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title><?php echo $__env->yieldContent('title','注册网烁帐号'); ?>-网烁信息科技有限公司</title>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords','keywords'); ?>"/>
    <meta name="description" content="<?php echo $__env->yieldContent('description','description'); ?>"/>
    <?php echo $__env->make('site.layouts.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>
<div id="register_body" >
    <div class="wrap" id="app">
        <div class="logo_bg">
            <a class="logo" href="/"><img src="<?php echo e(json_decode(getImages(setting('system_logo')),true)[0]['url'] ?? ''); ?>"></a>
        </div>
        <h5 class="typeName">注册新用户</h5>
        <ul class="register_type">
            <li class="<?php if(!request()->has('type')): ?> active <?php endif; ?>"  onclick="location.href='<?php echo e(route('register')); ?>'">手机注册</li>
            <li class="<?php if(request()->has('type')): ?> active <?php endif; ?>" onclick="location.href='<?php echo e(route('register')); ?>?type=email'">邮箱注册</li>
            <div class="clear"></div>
        </ul>
        <div class="registerInfoBox">
            <div class="method_box tab_box" >
                <?php if(!request()->has('type')): ?>
                    <?php if ($__env->exists('site.registers.phone')) echo $__env->make('site.registers.phone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                    <?php if ($__env->exists('site.registers.email')) echo $__env->make('site.registers.email', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <div class="step4" v-if="next_step">
                    <ul name="mobile"  class="tab">
                        <li :class="{ errorBorder: errors.has('username') }">
                            <label>
                                <input type="text"
                                       v-model="username"
                                       name="username"
                                       v-validate="'required|alpha_num|min:4|max:15|number_unique'"
                                       data-vv-as="用户名"
                                       placeholder="用户名（4-15位英文,数字,下划线）"
                                >
                            </label>
                            <div class="vee_error" v-show="errors.has('username')"><i></i>
                                <p>{{ errors.first('username') }}</p></div>
                        </li>

                        <?php if(!request()->has('type')): ?>
                            <li :class="{ errorBorder: errors.has('email') }" >
                                <label>
                                    <input type="text"
                                           v-model="email"
                                           name="email"
                                           v-validate="'required|email|number_unique'"
                                           data-vv-as="邮箱"
                                           placeholder="请输入邮箱"
                                    >
                                </label>
                                <div class="vee_error" v-show="errors.has('email')"><i></i>
                                    <p>{{ errors.first('email') }}</p></div>
                            </li>
                        <?php else: ?>
                            <li :class="{ errorBorder: errors.has('phone') }" >
                                <label>
                                    <input type="text"
                                           v-model="phone"
                                           name="phone"
                                           v-validate="'required|mobile|number_unique'"
                                           data-vv-as="手机号"
                                           placeholder="请输入手机号"
                                    >
                                </label>
                                <div class="vee_error" v-show="errors.has('phone')"><i></i>
                                    <p>{{ errors.first('phone') }}</p></div>
                            </li>
                       <?php endif; ?>

                        <li :class="{ errorBorder: errors.has('password') }">
                            <label>
                                <input type="password"
                                       v-model="password"
                                       name="password"
                                       v-validate="'required|alpha_num|min:6|max:20'"
                                       data-vv-as="密码"
                                       placeholder="密码（6-20位数字、英文）"
                                       ref="password"
                                >
                            </label>
                            <div class="vee_error" v-show="errors.has('password')"><i></i>
                                <p>{{ errors.first('password') }}</p></div>
                        </li>
                        <li :class="{ errorBorder: errors.has('password_confirmation ') }">
                            <label>
                                <input type="password"
                                       v-model="password_confirmation "
                                       name="password_confirmation "
                                       v-validate="'required|alpha_num|min:6|max:20|confirmed:password'"
                                       data-vv-as="确认密码"
                                       placeholder="再次输入密码"
                                >
                            </label>
                            <div class="vee_error" v-show="errors.has('password_confirmation ')"><i></i>
                                <p>{{ errors.first('password_confirmation ') }}</p></div>
                        </li>
                    </ul>
                    <div class="agrees">
                        <input type="checkbox"
                               class="agree"
                               v-model="checked "
                               name="checked "
                               v-validate="'required'"
                               data-vv-as="服务条例"
                               :checked="checked"
                        >
                        我已经阅读并接受<a href="{:U('/support_40')}" target="_blank">《网烁科技服务条例》</a>
                        <div class="vee_error" v-show="errors.has('checked ')"><i></i>
                            <p>{{ errors.first('checked ') }}</p></div>
                    </div>
                    <div class="button sub_now"  @click="save('<?php echo e(route('register.create')); ?>',<?php if(!request()->has('type')): ?>phone <?php else: ?> email <?php endif; ?>,'<?php if(!request()->has('type')): ?>phone <?php else: ?> email <?php endif; ?>')"><a>确认提交</a></div>
            </div>
                <!-- 第三步完成  -->
            </div>
        </div>

        <div class="method_box tab_box">
            <div class="loginNow">我有帐户，<a href="<?php echo e(route('login')); ?>">马上登录</a></div>
        </div>

    </div>
</div>

<div id="register_foot">
    <div class="wrap">
        <h5>
            <a href="http://www.miitbeian.gov.cn"><?php echo e(setting('system_website_records')); ?></a><br/>
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=51010702001250" style="display:inline-block;text-decoration:none">
                <img src="<?php echo e(asset('pic/beian.png')); ?>" style="margin-right:3px; vertical-align:middle;"/><?php echo e(setting('system_ministry_public_security_records')); ?></a><br>
            Copyright © <span class="year"><?php echo e(today()->format('Y')); ?></span> <?php echo e(setting('system_title')); ?> 版权所有
        </h5>
    </div>
</div>

</body>
<?php echo $__env->make('site.layouts.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" src="<?php echo e(asset('js/register.js')); ?>"></script>
<script>
        var url="<?php echo e(route('site.login')); ?>";
        var location_url="<?php echo url()->previous(); ?>";
</script>
</html>
