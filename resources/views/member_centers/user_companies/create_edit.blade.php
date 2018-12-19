<div class="edit" v-show="create_edit">
    <div class="editNum emailBox" >
        <h5 class="title">@{{ title }}信息</h5>
        <div  >
            <div class="editBox">
                {!! Form::open(['route'=>'user_companies.store','method'=>'post','id'=>'address','onsubmit'=>'return false']) !!}
                <ul class="safeUl">
                    {!!  Form::hidden('info.id',old('info.id'),['v-if'=>'info.id','v-model'=>'info.id']) !!}
                    <li :class="{ errorBorder: errors.has('info.number')}">
                        <label>序号 </label>
                        {!!  Form::select('info.number',letter(),old('info.number'),[
                        'placeholder'=>'请选择序号',
                        "v-validate"=>"'required'",
                        'v-model'=>'info.number',
                         'data-vv-as'=>"序号"
                        ]) !!}

                        <div class="vee_error" v-show="errors.has('info.number')"><i></i>
                            <p>@{{ errors.first('info.number') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.name') }">
                        <label>企业全称</label>
                        <input type="text"
                               v-model="info.name"
                               name="info.name"
                               v-validate="'required'"
                               data-vv-as="企业全称"
                               placeholder="例：成都网烁信息科技有限公司"
                        >
                        <div class="vee_error" v-show="errors.has('info.name')"><i></i>
                            <p>@{{ errors.first('info.name') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.address') }">
                        <label>注册地址</label>
                        <input type="text"
                               v-model="info.address"
                               name="info.address"
                               v-validate="'required'"
                               data-vv-as="注册地址"
                               placeholder="例：成都市武侯区武侯新城管委会武科西三路2号1栋1层5号"
                        >
                        <div class="vee_error" v-show="errors.has('info.address')"><i></i>
                            <p>@{{ errors.first('info.address') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.unit_phone') }">
                        <label>联系电话</label>
                        <input type="text"
                               v-model="info.unit_phone"
                               name="info.unit_phone"
                               v-validate="'required|mobile'"
                               data-vv-as="联系电话"
                               placeholder="例：028-68881968"
                        >
                        <div class="vee_error" v-show="errors.has('info.unit_phone')"><i></i>
                            <p>@{{ errors.first('info.unit_phone') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.tax_mode')}">
                        <label>含税类型 </label>
                        {!!  Form::select('info.tax_mode',config('site.member_center_invoice'),old('info.tax_mode'),[
                        'placeholder'=>'请选择含税类型',
                        "v-validate"=>"'required'",
                        'v-model'=>'info.tax_mode',
                         'data-vv-as'=>"含税类型"
                        ]) !!}

                        <div class="vee_error" v-show="errors.has('info.tax_mode')"><i></i>
                            <p>@{{ errors.first('info.tax_mode') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.fax') }">
                        <label>传真号码</label>
                        <input type="text"
                               v-model="info.fax"
                               name="info.fax"
                               data-vv-as="传真号码"
                               placeholder="例：028-85098783"
                        >
                        <div class="vee_error" v-show="errors.has('info.fax')"><i></i>
                            <p>@{{ errors.first('info.fax') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.zip') }">
                        <label>邮政编码</label>
                        <input type="text"
                               v-model="info.zip"
                               name="info.zip"
                               placeholder="例：610000"
                        >
                        <div class="vee_error" v-show="errors.has('info.zip')"><i></i>
                            <p>@{{ errors.first('info.zip') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.url') }">
                        <label>企业网址</label>
                        <input type="text"
                               v-model="info.url"
                               name="info.url"
                               data-vv-as="企业网址"
                               v-validate="'url'"
                               placeholder="例：www.waso.com.cn"
                        >
                        <div class="vee_error" v-show="errors.has('info.url')"><i></i>
                            <p>@{{ errors.first('info.url') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.tax_number') }">
                        <label>企业税号</label>
                        <input type="text"
                               v-model="info.tax_number"
                               name="info.tax_number"
                               data-vv-as="企业税号"
                               placeholder="例：915101076909194519"
                        >
                        <div class="vee_error" v-show="errors.has('info.tax_number')"><i></i>
                            <p>@{{ errors.first('info.tax_number') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.account') }">
                        <label>银行账号</label>
                        <input type="text"
                               v-model="info.account"
                               name="info.account"
                               data-vv-as="银行账号"
                               placeholder="例：915101076909194519"
                        >
                        <div class="vee_error" v-show="errors.has('info.account')"><i></i>
                            <p>@{{ errors.first('info.account') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.opening_bank') }">
                        <label>开户银行</label>
                        <input type="text"
                               v-model="info.opening_bank"
                               name="info.opening_bank"
                               data-vv-as="开户银行"
                               placeholder="例：中信银行成都人民南路支行"
                        >
                        <div class="vee_error" v-show="errors.has('info.opening_bank')"><i></i>
                            <p>@{{ errors.first('info.opening_bank') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.bank_address') }">
                        <label>开户行地址</label>
                        <input type="text"
                               v-model="info.bank_address"
                               name="info.bank_address"
                               data-vv-as="开户行地址"
                               placeholder="例：四川省成都市武侯区人民南路三段29号"
                        >
                        <div class="vee_error" v-show="errors.has('info.bank_address')"><i></i>
                            <p>@{{ errors.first('info.bank_address') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.bank_phone') }">
                        <label>开户行电话</label>
                        <input type="text"
                               v-model="info.bank_phone"
                               name="info.bank_phone"
                               data-vv-as="开户行电话"
                               placeholder="例：028-85450406"
                        >
                        <div class="vee_error" v-show="errors.has('info.bank_phone')"><i></i>
                            <p>@{{ errors.first('info.bank_phone') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.finance') }">
                        <label>财务人员</label>
                        <input type="text"
                               v-model="info.finance"
                               name="info.finance"
                               data-vv-as="财务人员"
                               placeholder="例：张xx"
                        >
                        <div class="vee_error" v-show="errors.has('info.finance')"><i></i>
                            <p>@{{ errors.first('info.finance') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.finance_phone') }">
                        <label>财务电话</label>
                        <input type="text"
                               v-model="info.finance_phone"
                               name="info.finance_phone"
                               data-vv-as="财务电话"
                               placeholder="例：028-68881968"
                        >
                        <div class="vee_error" v-show="errors.has('info.finance_phone')"><i></i>
                            <p>@{{ errors.first('info.finance_phone') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.logistics') }">
                        <label>票据收件信息</label>
                        <input type="text"
                               v-model="info.logistics"
                               name="info.logistics"
                               data-vv-as="票据收件信息"
                               placeholder="例：成都市高新区高朋东路2号 搏润科技园101号 刘芳 13608009055"
                        >
                        <div class="vee_error" v-show="errors.has('info.logistics')"><i></i>
                            <p>@{{ errors.first('info.logistics') }}</p></div>
                    </li>
                </ul>
                {!! Form::close() !!}
                <div class="button goStep2" style="width: 45%" @click="save()">保存</div>
                <div class="button cancel"@click="cancel()"> 取 消</div>
                <div class="clear"></div>
            </div>
        </div>
        <!--   解绑 -->
    </div>

</div>