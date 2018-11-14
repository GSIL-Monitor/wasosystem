@extends('admin.layout.default')
@section('js')
    <script src="{{ asset('admin/js/code.js') }}"></script>
    <script>
        $(function () {
            $(document).on('change','.product',function () {
                filtrate($(this),"{{ route('admin.procurement_plans.get_goods') }}")
            })
        });
        var vm = new Vue({
            el: "#app",
            data: {
                @if(isset($put_in_storage_management))
                isDisabled: true,
                @else
                isDisabled: false,
                @endif
                disabled: false,
                procurement_number:'',
                two_code:'',
                code: '',
                finish_procurement_number_count:{!! $put_in_storage_management->finish_procurement_number ?? 0 !!},
                @if(isset($put_in_storage_management) && !empty(array_filter($put_in_storage_management->code ?? [])))
                codes:{!! json_encode($put_in_storage_management->code,true) !!},
                @else
                codes: [],
                @endif
                finish: false,
                show: true

            },
            methods: {
                del: function (index) {
                    this.codes.splice(index, 1)
                    this.finish_procurement_number_count--;
                    this.disabled = false;
                },
                in_array: function (code) {
                    var codes = ',' + this.codes.join(',') + ',';
                    return codes.indexOf("," + code + ",") != -1;
                },
                entering: function () {
                    if (!this.in_array(this.code)) {
                        this.checkCode(this.code);
                    } else {
                        showError($('.finish_procurement_number'), '录入条码已存在')
                        this.code = '';
                    }
                },
                checkCode: function (code) {
                    axios.post("{{ route('admin.put_in_storage_managements.checkCode') }}", {
                        "_token": getToken(),
                        "code": code
                    }).then(function (response) {
                        if (response.data > 0) {
                            showError($('.finish_procurement_number'), '录入条码已存在')
                            vm.code = '';
                        } else {
                            vm.codes.push(code)
                            vm.code = '';
                            hideError($('.finish_procurement_number'))
                            vm.finish_procurement_number_count++;
                            if (vm.finish_procurement_number_count == vm.procurement_number) {
                                vm.disabled = true;
                            }
                            console.log(vm.codes);
                        }
                    }).catch(function (err) {

                    });
                },
                checkNumber:function () {
                 if(this.procurement_number < this.finish_procurement_number_count){
                     showError($('.finish_procurement_number'), '确认数量不能小于已录入数量')
                 }else{
                     hideError($('.finish_procurement_number'))
                     this.disabled = false;
                 }
                }
            },
            mounted: function () {
                $('.finish_procurement_number').focus();
            },
        });

    </script>
@endsection
@section('content')
    <div class="nowWebBox">
        <div class="PageBtn">
            <div class="phoneBtns">
                <button class="Btn Refresh ">刷新</button>
                @can('create put_in_storage_managements')
                    <button type="submit" class="Btn common_add" form_id="put_in_storage_managements"
                            location="top">保存
                    </button>
                @endcan
            </div>
            <div class="phoneBtnOpen"></div>
        </div>
        <div class="PageBox">
            @include('admin.put_in_storage_managements.form')
        </div>
    </div>

@endsection