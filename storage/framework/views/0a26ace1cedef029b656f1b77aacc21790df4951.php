<dd>
    <div class="nowInfo" v-if="!edit_email && !new_email">
        <span class="tit">邮箱</span>
        <span class="name">
                                            <h5> <?php if(!user()->email): ?>未绑定 <?php else: ?> <?php echo e(user()->email); ?> <?php endif; ?></h5>
                                            <h6> <?php if(!user()->email): ?>绑定后可以通过邮箱找回密码 <?php else: ?> 已验证，可通过邮箱找回密码 <?php endif; ?></h6>
                                    </span>
        <span class="control">
                            <?php if(!user()->email): ?>
                <a class="setNew" @click="bind_new('email')">绑定</a>
            <?php else: ?>
                <a class="editOld" @click="edit('email')">修改</a>
            <?php endif; ?>

  </span>
    </div>
    <!--   当前帐号  -->
    <div class="editNum emailBox" v-if="edit_email || new_email">
        <div  v-if="edit_email">
            <h5 class="boxTit">修改绑定邮箱（验证旧邮箱）</h5>
            <div class="editBox">
                <ul class="safeUl">
                    <li :class="{ errorBorder: errors.has('email') }">
                        <label>旧邮箱</label>
                        <input type="text"
                               disabled
                               value="<?php echo e(user()->email); ?>"

                        >
                    </li>
                    <li :class="{ errorBorder: errors.has('email_code') }">
                        <label>验证码</label>
                        <input type="text"
                               v-model="email_code"
                               name="email_code"
                               v-validate="'required|alpha_num|min:6|max:6'"
                               data-vv-as="验证码"
                        >
                        <div class="vee_error" v-show="errors.has('email_code')"><i></i>
                            <p>{{ errors.first('email_code') }}</p></div>
                        <a class="repSend canSend" @click="send('<?php echo e(route('binding_authorization.send')); ?>','<?php echo e(user()->email); ?>')">{{content}}</a></li>
                </ul>
                <div class="button goStep2" @click="check_code('<?php echo e(route('binding_authorization.check_code')); ?>','email_code')">确 认</div>
                <div class="button cancel" @click="cancel('email')"> 取 消</div>
                <div class="clear"></div>
            </div>
        </div>
        <!--   解绑 -->

        <div class="" v-if="new_email">
            <h5 class="boxTit">绑定新邮箱（绑定新邮箱）</h5>
            <div class="editBox">
                <ul class="safeUl">

                    <li :class="{ errorBorder: errors.has('email') }">
                        <label>新邮箱</label>
                        <input type="text"
                               v-model="email"
                               name="email"
                               v-validate="'required|email|number_unique'"
                               data-vv-as="新邮箱"
                        >
                        <div class="vee_error" v-show="errors.has('email')"><i></i>
                            <p>{{ errors.first('email') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('email_code') }">
                        <label>验证码</label>
                        <input type="text"
                               v-model="email_code"
                               name="email_code"
                               v-validate="'required|alpha_num|min:6|max:6'"
                               data-vv-as="验证码"
                        >
                        <div class="vee_error" v-show="errors.has('email_code')"><i></i>
                            <p>{{ errors.first('email_code') }}</p></div>
                        <a class="repSend canSend" @click="send('<?php echo e(route('binding_authorization.send')); ?>',email)">{{content}}</a></li>
                </ul>
                <div class="button goStep3" @click="bind('<?php echo e(route('binding_authorization.bind')); ?>',email,'email')">确 认</div>
                <div class="button cancel"  @click="cancel('email')">取 消</div>
                <div class="clear"></div>
            </div>
        </div>
        <!--   接收验证码 -->
    </div>
</dd>