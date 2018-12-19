<div class="edit" v-show="create_edit">

    <div class="editNum emailBox" >
        <h5 class="title">@{{ title }}信息</h5>
        <div  >
            <div class="editBox">
                {!! Form::open(['route'=>'user_addresses.store','method'=>'post','id'=>'address','onsubmit'=>'return false']) !!}
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
                        <label>收 货 人</label>
                        <input type="text"
                               v-model="info.name"
                               name="info.name"
                               v-validate="'required'"
                               data-vv-as="收 货 人"
                               placeholder="例：成都网烁"
                        >
                        <div class="vee_error" v-show="errors.has('info.name')"><i></i>
                            <p>@{{ errors.first('info.name') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.address') }">
                        <label>收货地址</label>
                        <input type="text"
                               v-model="info.address"
                               name="info.address"
                               v-validate="'required'"
                               data-vv-as="收货地址"
                               placeholder="例：成都市高新区高朋东路2号搏润科技园101号"
                        >
                        <div class="vee_error" v-show="errors.has('info.address')"><i></i>
                            <p>@{{ errors.first('info.address') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.phone') }">
                    <label>联系电话</label>
                    <input type="text"
                           v-model="info.phone"
                           name="info.phone"
                           v-validate="'required|mobile'"
                           data-vv-as="联系电话"
                           placeholder="例：028-68881968"
                    >
                    <div class="vee_error" v-show="errors.has('info.phone')"><i></i>
                        <p>@{{ errors.first('info.phone') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.alternative_phone') }">
                        <label>备用电话</label>
                        <input type="text"
                               v-model="info.alternative_phone"
                               name="info.alternative_phone"
                               v-validate="'mobile'"
                               data-vv-as="备用电话"
                               placeholder="例：028-68881968"
                        >
                        <div class="vee_error" v-show="errors.has('info.alternative_phone')"><i></i>
                            <p>@{{ errors.first('info.alternative_phone') }}</p></div>
                    </li>
                    <li :class="{ errorBorder: errors.has('info.logistics') }">
                        <label>指定物流</label>
                        <input type="text"
                               v-model="info.logistics"
                               name="info.logistics"
                               placeholder="例：顺丰快递、EMS"
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