@extends('admin.layout.default')
@section('js')
    <script>
        $(function () {
            $(document).on('click','.setting_del',function () {
              var url=$(this).attr('data_url');
              var key=$(this).attr('key');
                axios.post(url, {
                    "_token": getToken(),
                    "_method": "delete",
                    "key": key
                })
                    .then(function (response) {
                        toastrMessage('success', '删除成功')
                    })
                    .catch(function (err) {
                        toastrMessage('error', '删除失败')
                    });
            });
        });
    </script>
 @endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create settings')
                    <button class="changeWeb Btn" data_url="{{ route('admin.settings.create') }}">添加</button>
                @endcan
            </div>
            {!! Form::open(['route'=>'admin.settings.store','method'=>'post']) !!}
                <div class="search">
                    key：{!!  Form::text('key',old('key'),['placeholder'=>'key',"required"]) !!}
                    值：{!!  Form::text('value',old('value'),['placeholder'=>'值',"required"]) !!}
                    <input type="submit" class="Btn green"  value="搜索">
                </div>
            </form>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            <div class="JJList">
                <ul class="maxUl" id="app">
                  <li>
                     <div class="liLeft">关键字：</div>
                     <div class="liRight">
                         {!! Form::open(['route'=>'admin.settings.create','method'=>'post','id'=>'settings']) !!}
                         @foreach($settings as $key=>$setting)
                            <label class="valLabel">
                              <div class="valLabelTit">{{ $setting }}：</div>
                              <div class="valLabelCont">
                                 {!!  Form::text($key.'.value',old($key.'.value',$key['value'] ?? ''),['placeholder'=>$setting,"class"=>'checkNull']) !!}
                                 <a data_url="{{ url('/waso/settings/destory') }}" class="setting_del" key={{ $key }}>删除</a>
                              </div>
                            </label>
                         @endforeach
                         {!! Form::close() !!}
                     </div>
                     <div class="clear"></div>
                  </li>
                  <div class="clear"></div>
                </ul>




 <!--                <ul class="maxUl" id="app">
                                    {!! Form::open(['route'=>'admin.settings.create','method'=>'post','id'=>'settings']) !!}
                                    @foreach($settings as $key=>$setting)
                                        <li>
                                            <div class="liLeft">{{ $setting }}：</div>
                                            <div class="liRight">
                                                {!!  Form::text($key.'.value',old($key.'.value',$key['value'] ?? ''),['placeholder'=>$setting,"class"=>'checkNull']) !!}
                                                <a data_url="{{ url('/waso/settings/destory') }}" class="setting_del" key={{ $key }}>删除</a>
                                            </div>
                                            <div class="clear"></div>
                                        </li>
                                        <div class="clear"></div>
                                        @endforeach
                                    {!! Form::close() !!}
                                </ul>   -->
            </div>
        </div>
    </div>
@endsection
