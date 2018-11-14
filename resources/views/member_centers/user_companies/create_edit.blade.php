<div class="edit" v-show="create_edit">
    <div class="addres_edit" >
        <h5 class="title">@{{ title }}信息</h5>
        <ul class="tab">
              {!! Form::open(['route'=>'user_companies.store','method'=>'post','id'=>'address','onsubmit'=>'return false']) !!}
                <li class="words"><span><i>*</i>设置编号：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::hidden('user_id',old('user_id',user()->id)) !!}
                        {!!  Form::hidden('id',old('id'),['v-if'=>'info.id','v-model'=>'info.id']) !!}
                    {!!  Form::select('number',letter(),old('number'),['placeholder'=>'序号',"class"=>'checkNull','v-model'=>'info.number']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li class="words"><span><i>*</i>企业全称：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('name',old('name'),['placeholder'=>'例：成都网烁信息科技有限公司',"class"=>'checkNull','v-model'=>'info.name']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>注册地址：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('address',old('address'),['placeholder'=>'例：成都市武侯区武侯新城管委会武科西三路2号1栋1层5号',"class"=>'checkNull','v-model'=>'info.address']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>联系电话：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('unit_phone',old('unit_phone'),['placeholder'=>'例：028-68881968',"class"=>'','v-model'=>'info.unit_phone']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li ><span>传真号码：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('fax',old('fax'),['placeholder'=>'例：028-85098783',"class"=>'','v-model'=>'info.fax']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>邮政编码：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('zip',old('zip'),['placeholder'=>'例：610000',"class"=>'','v-model'=>'info.zip']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li ><span>企业网址：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('url',old('url'),['placeholder'=>'例：www.waso.com.cn',"class"=>'','v-model'=>'info.url']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span><i>*</i>含税类型：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                          {!!  Form::select('tax_mode',config('site.member_center_invoice'),old('tax_mode'),["class"=>'','v-model'=>'info.tax_mode']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>企业税号：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('tax_number',old('tax_number'),['placeholder'=>'例：915101076909194519',"class"=>'','v-model'=>'info.tax_number']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li ><span>银行账号：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('account',old('account'),['placeholder'=>'例：7411 8101 8220 0099 501',"class"=>'','v-model'=>'info.account']) !!}

           </div>
                    <div class="clear"></div>
                </li>
                <li ><span>开户银行：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('opening_bank',old('opening_bank'),['placeholder'=>'例：中信银行成都人民南路支行',"class"=>'','v-model'=>'info.opening_bank']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li ><span>开户行地址：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('bank_address',old('bank_address'),['placeholder'=>'例：四川省成都市武侯区人民南路三段29号',"class"=>'','v-model'=>'info.bank_address']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li ><span>开户行电话：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('bank_phone',old('bank_phone'),['placeholder'=>'例：028-85450406',"class"=>'','v-model'=>'info.bank_phone']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>财务人员：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('finance',old('finance'),['placeholder'=>'例：小明',"class"=>'','v-model'=>'info.finance']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li ><span>财务电话：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i>
                            <p></p></div>
                        {!!  Form::text('finance_phone',old('finance_phone'),['placeholder'=>'例：028-68881968',"class"=>'','v-model'=>'info.finance_phone']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>票据收件信息：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('logistics',old('logistics'),['placeholder'=>'例：成都市高新区高朋东路2号 搏润科技园101号 刘芳 13608009055',"class"=>'','v-model'=>'info.logistics']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                {!! Form::close() !!}
            <div class="clear"></div>
        </ul>

        <div class="btns">
            <div class="button HalfBtn" @click="save()"><a>保存</a></div>
            <div class="button HalfBtn close" @click="cancel()"><a>取消</a></div>
            <div class="clear"></div>
        </div>

        </form>
    </div>
</div>