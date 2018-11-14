
<?php $__env->startSection('title','问题反馈/建议'); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('css/feedback.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('js/feedback.js')); ?>"></script>
    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="body">
        <div id="crumbs">
            <div class="wrap">
                <a href="/">首页</a> > 问题反馈/建议
            </div>
        </div>

        <div class="wrap">
            <div class="form_box" id="app">
                <p>
                    网烁非常重视自身的产品以及业务系统的安全问题和使用便利性。我们欢迎广大用户向我们反馈您在使用或者浏览网站时所遇到的问题，和您觉得我们需要改进的地方。如果您在咨询、购买，使用等情况下遇到问题，也欢迎向我们反映！</p>
                <p>我们将在第一时间进行阅读以及商讨您的建议，如果您的建议符合我们的改进条件及要求，我们将尽快完成修改。修改最新近况我们将以邮件方式反馈给您。</p>
                    <?php echo e(Form::open(['route'=>'service_support.feedback_save','onsubmit'=>'return false;','class'=>'feedback_save'])); ?>

                <input
                        :class="{feedback_error_border:errors.has('name')}"
                        type="text"
                        name="name"
                        v-model="name"
                        v-validate="'required'"
                        data-vv-as="称呼"
                        placeholder="您的称呼 *"
                />
                <span class="feedback_error"  v-show="errors.has('name')"><i></i>
                        {{ errors.first('name') }}</span>
                <input
                        :class="{feedback_error_border:errors.has('phone')}"
                        type="text"
                        name="phone"
                        v-model="phone"
                        v-validate="'mobile'"
                        data-vv-as="电话号码"
                        placeholder="您的电话号码 *"
                />
                <span class="feedback_error"  v-show="errors.has('phone')"><i></i>
                        {{ errors.first('phone') }}</span>
                    <input
                            :class="{feedback_error_border:errors.has('email')}"
                            type="email"
                           name="email"
                           v-model="email"
                           v-validate="'required|email'"
                           data-vv-as="邮箱"
                           placeholder="您的电子邮箱 *"
                    />
                <span class="feedback_error"  v-show="errors.has('email')"><i></i>
                        {{ errors.first('email') }}</span>
                    <input
                            :class="{feedback_error_border:errors.has('title')}"
                            name="title"
                           v-model="title"
                           v-validate="'required|min:5|max:255'"
                           data-vv-as="标题"
                           placeholder="标题 *"
                  />
                    <span class="feedback_error"  v-show="errors.has('title')"><i></i>
                        {{ errors.first('title') }}</span>
                    <textarea
                             :class="{feedback_error_border:errors.has('content')}"
                             name="content"
                              v-model="content"
                              v-validate="'required|min:15|max:1000'"
                              data-vv-as="内容"
                              placeholder="具体内容 *"
                        >
                    </textarea>
                    <span class="feedback_error"  v-show="errors.has('content')"><i></i>
                        {{ errors.first('content') }}</span>
                    <div class="checkPic">

                            <label>
                                <input
                                       :class="{feedback_error_border:errors.has('captcha')}"
                                       type="text"
                                       name="captcha"
                                       v-model="captcha"
                                       v-validate="'required'"
                                       data-vv-as="验证码"
                                       placeholder="输入验证码 *"
                                >
                            </label>
                        <div class="code_pic">
                            <img title="点击刷新" id="che_pic" height="40" src="<?php echo captcha_src('waso'); ?>" onClick="this.src=this.src+'?'+Math.random()" style="cursor: pointer">
                        </div>
                        <div class="clear"></div>
                    </div>
                    <span class="feedback_error"  v-show="errors.has('captcha')"><i></i>
                        {{ errors.first('captcha') }}</span>

                    <a class="btn" @click="save()">提交</a>
                <?php echo e(Form::close()); ?>

                <div class="pro_feed">*我遇到的是关于产品的技术问题<a href="<?php echo e(route('service_support.index')); ?>">点击这里</a>*</div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('site.layouts.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>