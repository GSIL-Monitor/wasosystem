<div class="edit" v-show="create_edit">
    <div class="addres_edit" >
        <h5 class="title">@{{ title }}信息</h5>
        <ul class="tab">
              {!! Form::open(['route'=>'user_addresses.store','method'=>'post','id'=>'address','onsubmit'=>'return false']) !!}
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
                <li class="words"><span><i>*</i>收 货 人：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('name',old('name'),['placeholder'=>'例：成都网烁',"class"=>'checkNull','v-model'=>'info.name']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>收货地址：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('address',old('address'),['placeholder'=>'例：成都市高新区高朋东路2号搏润科技园101号',"class"=>'checkNull','v-model'=>'info.address']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li><span>联系电话：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('phone',old('phone'),['placeholder'=>'例：028-68881968',"class"=>'checkNull','v-model'=>'info.phone']) !!}
                    </div>
                    <div class="clear"></div>
                </li>
                <li ><span>备用电话：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('alternative_phone',old('alternative_phone'),['placeholder'=>'例：028-68881968',"class"=>'','v-model'=>'info.alternative_phone']) !!}
                    </div>
                    <div class="clear"></div>
                </li>

                <li><span>指定物流：</span>
                    <div class="info_in">
                        <div class="suc_msg"></div>
                        <div class="error_msg"><i></i><p></p></div>
                        {!!  Form::text('logistics',old('logistics'),['placeholder'=>'例：顺丰快递、EMS',"class"=>'','v-model'=>'info.logistics']) !!}
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