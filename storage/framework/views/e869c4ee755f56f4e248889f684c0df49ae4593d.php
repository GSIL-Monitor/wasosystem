<dd>
    <div class="nowInfo" v-if="!edit_phone && !new_phone">
        <span class="tit">手机号</span>
        <span class="name">
                                         <h5><?php if(!user()->phone): ?>未绑定 <?php else: ?> <?php echo e(user()->phone); ?> <?php endif; ?></h5>
                                        <h6><?php if(!user()->phone): ?>绑定后可以通过手机找回密码 <?php else: ?> 已验证，可通过手机找回密码 <?php endif; ?></h6>
                                    </span>
        <span class="control">
                 <?php if(!user()->phone): ?>
                <a class="setNew" @click="bind_new('phone')">绑定</a>
            <?php else: ?>
                <a class="editOld" @click="edit('phone')">修改</a>
            <?php endif; ?>

  </span>
    </div>
    <!--   当前帐号  -->
    <div class="editNum emailBox" v-if="edit_phone || new_phone">
        <div  v-if="edit_phone">
            <h5 class="boxTit">修改绑定手机号（验证旧手机号）</h5>
            <div class="editBox">
                <ul class="safeUl">
                    <li :class="{ errorBorder: errors.has('phone') }">
                        <label>旧号码</label>
                        <input type="text"
                               disabled
                               value="<?php echo e(user()->phone); ?>"
                        >
                    </li>
                    <li :class="{ errorBorder: errors.has('phone_code') }">
                        <label>验证码</label>
                        <input type="text"
                               v-model="phone_code"
                               name="phone_code"
                               v-validate="'required|alpha_num|min:6|max:6'"
                               data-vv-as="验证码"
                        >
                        <div class="vee_error" v-show="errors.has('phone_code')"><i></i>
                            <p>{{ errors.first('phone_code') }}</p></div>
                        <a class="repSend canSend" @click="send('<?php echo e(route('binding_authorization.send')); ?>','<?php echo e(user()->phone); ?>')">{{content}}</a></li>
                </ul>
                <div class="button goStep2" @click="check_code('<?php echo e(route('binding_authorization.check_code')); ?>','phone_code')">确 认</div>
                <div class="button cancel" @click="cancel('phone')"> 取 消</div>
                <div class="clear"></div>
            </div>
        </div>
        <!--   解绑 -->

        <div v-if="new_phone">
            <h5 class="boxTit">绑定新号码（绑定新号码）</h5>
            <div class="editBox">
                <ul class="safeUl">
                    <li :class="{ errorBorder: errors.has('phone') }">
                        <label>新号码</label>
                        <input type="text"
                               v-model="phone"
                               name="phone"
                               v-validate="'required|mobile|number_unique'"
                               data-vv-as="手机号"
                              >
                        <div class="vee_error" v-show="errors.has('phone')"><i></i>
                            <p>{{ errors.first('phone') }}</p></div>
                    </li>
                    <li  :class="{ errorBorder: errors.has('phone_code') }">
                        <label>验证码</label>
                        <input type="text"
                               v-model="phone_code"
                               name="phone_code"
                               v-validate="'required|alpha_num|min:6|max:6'"
                               data-vv-as="验证码"
                               >
                        <div class="vee_error" v-show="errors.has('phone_code')"><i></i>
                            <p>{{ errors.first('phone_code') }}</p></div>
                        <a class="repSend canSend" @click="send('<?php echo e(route('binding_authorization.send')); ?>',phone)">{{content}}</a></li>
                </ul>
                <div class="button goStep3" @click="bind('<?php echo e(route('binding_authorization.bind')); ?>',phone,'phone')">确 认</div>
                <div class="button cancel"  @click="cancel('phone')">取 消</div>
                <div class="clear"></div>
            </div>
        </div>
        <!--   接收验证码 -->
    </div>
</dd>