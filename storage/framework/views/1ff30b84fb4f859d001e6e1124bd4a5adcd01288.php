
    <div class="step1" v-show="!next_step">
        <ul name="mobile" class="tab">
            <li :class="{ errorBorder: errors.has('email') }">
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
            <li  :class="{ errorBorder: errors.has('email_code') }">
                <label>
                    <input type="text"
                           v-model="email_code"
                           name="email_code"
                           v-validate="'required|alpha_num|min:6|max:6'"
                           data-vv-as="验证码"
                           placeholder="请输入邮箱验证码"
                    >
                </label>
                <div class="vee_error" v-show="errors.has('email_code')"><i></i>
                    <p>{{ errors.first('email_code') }}</p></div>
                <a class="repSend canSend" @click="send('<?php echo e(route('binding_authorization.send')); ?>',email,'email')">{{content}}</a></li>

        </ul>
        <div class="button goStep2" @click="next('<?php echo e(route('binding_authorization.check_code')); ?>',email,'email')"><i class="wait"><img src="<?php echo e(asset('pic/wait.gif')); ?>"></i><a>下一步</a></div>
    </div>
    <!-- 第一步完成  -->
