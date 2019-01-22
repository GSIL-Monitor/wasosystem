
    <div class="step1" v-show="!next_step">
        <ul name="mobile" class="tab">
            <li :class="{ errorBorder: errors.has('phone') }">
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
            <li  :class="{ errorBorder: errors.has('phone_code') }">
                <label>
                <input type="text"
                       v-model="phone_code"
                       name="phone_code"
                       v-validate="'required|alpha_num|min:6|max:6'"
                       data-vv-as="验证码"
                       placeholder="请输入手机验证码"
                >
                </label>
                <div class="vee_error" v-show="errors.has('phone_code')"><i></i>
                    <p>{{ errors.first('phone_code') }}</p></div>
                <a class="repSend canSend" @click="send('<?php echo e(route('binding_authorization.send')); ?>',phone,'phone')">{{content}}</a></li>

        </ul>
        <div class="button goStep2" @click="next('<?php echo e(route('binding_authorization.check_code')); ?>',phone,'phone')"><i class="wait"><img src="<?php echo e(asset('pic/wait.gif')); ?>"></i><a>下一步</a></div>
    </div>
    <!-- 第一步完成  -->

