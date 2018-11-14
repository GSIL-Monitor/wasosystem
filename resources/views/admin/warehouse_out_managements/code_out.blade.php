@extends('admin.layout.default')
@inject('WarehouseOutManagementParamenter','App\Presenters\WarehouseOutManagementParamenter')
@section('js')
    <script>
        function cteate_codes() {
            var arr={};
            var codes={};
            $(".listTable tr td input").each(function () {
                var id=$(this).attr('data-id');
                console.log(id);
                var code=$(this).val();
                var number=$(this).attr('data-number');
                var num=$(this).attr('data-num');
                if(arr[id] == undefined){
                    arr[id]={};
                    arr[id]['product_good_id']=id;
                    arr[id]['product_good_number']=number;
                    arr[id]['product_good_num']=num;
                    arr[id]['code']=[code];
                    codes[id]=[code]
                }else{
                   arr[id]['code'].push(code)
                   arr[id]['product_good_num']=arr[id]['code'].length;
                   codes[id].push(code)
                }
            })
//            console.log(JSON.stringify(arr));
            $('.codes').val(JSON.stringify(arr));
            return codes;
        }
        var vm=new Vue({
            el:"#warehouse_out_managements",
            data:{
                code: '',
                @if(Route::is('admin.warehouse_out_managements.code_out'))
                out_storage_storage_counts:0,
                out_storage_count:0,
                codes:{},
                code_arrs: {},
                @else
                out_storage_storage_counts:{!! $warehouse_out_management->out_number ?? 0 !!},
                out_storage_count:{!! $warehouse_out_management->finish_out_number ?? 0 !!},
                codes:{},
                code_arrs:{!! $WarehouseOutManagementParamenter->codeToJson($warehouse_out_management->codes) !!},
                @endif
                disabled:false,
            },
            methods: {
                del: function (index,code) {
                    delete this.code_arrs[index][code];//删除数组
                    this.out_storage_count--;
                  setTimeout(function () {
                      vm.codes=cteate_codes();
                  },100)
                    this.disabled = false;
                },
                in_array: function (code) {
                    var codes="";
                    for(var item in this.codes){
                        codes += ',' + this.codes[item].join(',') + ',';
                    };
                    console.log(codes)
                    return codes.indexOf("," + code + ",") != -1;
                },
                entering: function () {
                    if (!this.in_array(this.code)) {
                        this.checkCode(this.code);
                    } else {
                        showError($('.out_storage'), '录入条码已存在')
                        this.code = '';
                    }
                },
                checkCode: function (code) {
                    axios.post("{{ route('admin.warehouse_out_managements.checkCode') }}", {
                        "_token": getToken(),
                        "code": code
                    }).then(function (response) {
                        var good_id=response.data.codes.product_good_id.toString();
                        var good_number=response.data.products.bianhao;
                        var good_type=response.data.products.title;
                        var good_name=response.data.product_good.name;
                        console.log(good_id)

                      if(good_id){
                          if(vm.codes.length == 0 || vm.codes[good_id] == undefined){
                              vm.codes[good_id]=[code]
                              vm.code_arrs[good_id]={};
                              console.log(1);
                              vm.code_arrs[good_id][code]={"id":good_id,"var":code,"bianhao":good_number,"num":1,"type":good_type,"name":good_name};
                          }else{
                              vm.codes[good_id].push(code);
                              console.log(2);
                              vm.code_arrs[good_id][code]={"id":good_id,"var":code,"bianhao":good_number,"num":1,"type":good_type,"name":good_name};
                          }
                          console.log(vm.code_arrs);
                          console.log(vm.codes);
                         setTimeout('cteate_codes()',100)
                          vm.out_storage_count++;
                          vm.code = '';
                          hideError($('.out_storage'))
                          if (vm.out_storage_count == vm.out_storage_storage_counts) {
                              vm.disabled = true;
                          }
                      }else{
                          showError($('.out_storage'), '没有这个条码')
                      }

                    }).catch(function (err) {

                    });
                },
                checkNumber:function () {
                    if(this.out_storage_count > this.out_storage_storage_counts){
                        showError($('.out_storage'), '出库数量不能大于总条码数量')
                    }else{
                        hideError($('.out_storage'))
                        this.disabled = false;
                    }
                }
            },
            mounted: function () {
                $('.out_storage').focus();
                this.codes=cteate_codes();
            },
        });
        $(function () {

        });
    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @if(Route::is('admin.warehouse_out_managements.create'))
                @can('create warehouse_out_managements')
                    <button type="submit" class="Btn common_add" form_id="warehouse_out_managements"
                            location="top">添加</button>
                 @endcan
                @else
                @can('edit warehouse_out_managements')
                    <button type="submit" class="Btn common_add" form_id="warehouse_out_managements"
                            location="top">修改</button>
                @endcan
                @endif
                <button class="changeWebClose Btn">返回</button>
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">

            <div class="JJList">
                <ul class="maxUl" >
                @if(Route::is('admin.warehouse_out_managements.code_out'))
                    {!! Form::open(['route'=>'admin.warehouse_out_managements.store','method'=>'post','id'=>'warehouse_out_managements','onsubmit'=>'return false']) !!}
                        @include('admin.warehouse_out_managements.form.code_out')
                @else
                    {!! Form::model($warehouse_out_management,['route'=>['admin.warehouse_out_managements.update',$warehouse_out_management->id],'id'=>'warehouse_out_managements','method'=>'put','onsubmit'=>'return false']) !!}
                    @include('admin.warehouse_out_managements.form.code_out_edit')
                @endif
                    <div class="clear"></div>
                    {!! Form::close() !!}
                </ul>
            </div>
        </div>
    </div>
@endsection