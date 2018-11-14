<div class="checkUser">
    <h5 class="boxTit">验证用户</h5>
    <div class="editBox">
        <ul class="safeUl">
            <li>
                <span >账户密码</span>
                <input type="hidden" val="" class="types"><input type="password" name="Pwd" class="Pwd">
                <div class="error_msg"><i></i>
                    <p></p></div>
            </li>
        </ul>
        <div class="button goStep1">确 认</div>
        <div class="button cancel">取 消</div>
        <div class="clear"></div>
    </div>
</div>

<div class="right">
    <div class="info">
        <div class="tit bigTit">
            <h5>绑定授权</h5>
            <p>网烁帐号绑定的第三方帐号，可用于直接登录网烁网站和找回密码使用</p>
        </div>

        <div class="safe">
            <dl>
            @include('member_centers.binding_authorizations.email')
            @include('member_centers.binding_authorizations.phone')
            </dl>
        </div>


    </div>
</div>
