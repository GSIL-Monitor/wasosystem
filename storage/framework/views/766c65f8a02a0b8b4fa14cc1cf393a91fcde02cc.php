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
    <link href="<?php echo e(asset('css/public.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/reset_password.css')); ?>" rel="stylesheet" type="text/css">
</head>
<body>
<div id="forget_body">
    <div class="wrap" id="app">

        <div class="logo_bg">
            <a class="logo" href="/"><img src="<?php echo e(asset('pic/logo.png')); ?>"></a>
        </div>
        <div v-show="!next_step">
            <h5 class="title">找回密码</h5>
            <ul class="forget_box tab_box tab">
                <li>
                    <label>
                        <select v-model="type">
                            <option :value="key" v-for="(item,key) in selects">{{ item }}</option>
                        </select>
                    </label>
                </li>

                <li :class="{ errorBorder: errors.has('number') }">
                    <label>
                        <input type="text"
                               v-model="number"
                               name="number"
                               v-validate="'required|unique'"
                               data-vv-as="邮箱或手机号"
                               placeholder="请输入邮箱或手机号"
                        >
                    </label>
                    <div class="vee_error" v-show="errors.has('number')"><i></i>
                        <p>{{ errors.first('number') }}</p></div>
                </li>
                <li :class="{ errorBorder: errors.has('code') }">
                    <label>
                        <input type="text"
                               v-model="code"
                               name="code"
                               v-validate="'required|alpha_num|min:6|max:6'"
                               data-vv-as="验证码"
                               :placeholder="请输入验证码"
                        >
                    </label>
                    <div class="vee_error" v-show="errors.has('code')"><i></i>
                        <p>{{ errors.first('code') }}</p></div>
                    <a class="repSend canSend" @click="send('<?php echo e(route('binding_authorization.send')); ?>',number,type)">{{content}}</a>
                </li>
            </ul>

            <div class="button GetMsg" @click="next('<?php echo e(route('binding_authorization.check_code')); ?>',number,type)"><i
                        class="wait"><img src="<?php echo e(asset('pic/wait.gif')); ?>"></i><a>下一步</a></div>
        </div>


        <div v-if="next_step">
            <h5 class="title">重置密码</h5>
            <ul class="forget_box tab_box tab">
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

            <div class="button submit" @click="save('<?php echo e(route('reset_password.reset')); ?>',number,type)"><a>重置密码</a></div>
        </div>


        <div class="other">
            <a href="<?php echo e(route('register')); ?>">注册新用户</a>
            <span>|</span>
            <a href="<?php echo e(route('login')); ?>">返回登录</a>
            </ul>
        </div>
    </div>
</div>

<div id="forget_foot">
    <div class="wrap">
        <h5>成都网烁信息科技有限公司 Copyright 2003-2016 <br>ICP备案编号：蜀 ICP(备)10025767号</h5>
    </div>
</div>

</body>
<?php echo $__env->make('site.layouts.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" src="<?php echo e(asset('js/reset_password.js')); ?>"></script>
<script>

</script>
</html>
