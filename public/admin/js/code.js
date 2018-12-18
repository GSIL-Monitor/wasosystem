function filtrate(obj,url) {
    var id=obj.val();
    var data_product_name=obj.attr("data_product_name");
    obj.parents('li').next().find('.good').remove()
    if(id !='0' && id !=''){
        obj.parents('li').next().find('.liRight').html("<select class='good select2' name='"+data_product_name+"'></select>");
        var $select =obj.parents('li').next().find('.liRight').find('.good');
        var instance;
        var data = [];
        axios.post(url,
            {"id":id}
        ).then(function (response) {
            console.log(response.data.length);
            if(response.data.length == 0){
                obj.parent().next().empty();
            }else{
                $.each(response.data,function (key,item){
                    data.push({id:'' + key, text:item});
                });
                instance = $select.data('select2');
                if(instance){
                    $select.select2('destroy').empty();
                }
                $select.select2({
                    placeholder: '请选择一个',
                    data: data
                });
            }
        });
    }
}
$(function(){

    $(document).on('click','.warehouse_out_add',function () {

        var out_status=$(this).attr('out_status');
        var form_id = $(this).attr('form_id');
        var method = $('#' + form_id).attr('method');
        var action = $('#' + form_id).attr('action');
        var form_data = $('#' + form_id).fixedSerialize();
        var location = $(this).attr('location');
        var out_number=$('input[name="out_number"]').val();
        var finish_out_number=$('input[name="finish_out_number"]').val();
        // var url = $(window.parent.frameElement).attr('src');
        if (checkError($('#' + form_id)) == "ok") {
            if(out_status == 'unfinished'){
                add_form(action, method, form_data+'&out_status='+out_status, form_id, location);
            }
            if(out_number != finish_out_number && out_status == 'finish'){
                swal('条码数量与出库数量不匹配','','warning');
                return false;
            }
            if(out_number == finish_out_number && out_status == 'finish'){
                add_form(action, method, form_data+'&out_status='+out_status, form_id, location);
            }

        } else if (checkError($('#' + form_id)) == "no") {
            return false;
        } else {
            return false;
        }

    });
    $(document).on('click','.procurement_plans_add',function () {
        var procurement_status=$(this).attr('procurement_status');
        var form_id = $(this).attr('form_id');
        var method = $('#' + form_id).attr('method');
        var action = $('#' + form_id).attr('action');
        var form_data = $('#' + form_id).fixedSerialize();
        var location = $(this).attr('location');
        var procurement_number=$('input[name="procurement_number"]').val();
        var finish_procurement_number=$('input[name="finish_procurement_number"]').val();
        var url = $(window.parent.frameElement).attr('src');
        if (checkError($('#' + form_id)) == "ok") {
            if(procurement_status == 'unfinished'){
                add_form(action, method, form_data+'&procurement_status='+procurement_status, form_id, location);
            }
            if(procurement_number != finish_procurement_number && procurement_status == 'finish'){
                swal('录入数量与采购数量不匹配','','warning');
                return false;
            }
            if(procurement_number == finish_procurement_number && procurement_status == 'finish'){
                swal('需要添加二级条码吗?','','warning').then(function () {
                    procurement_status='unfinished';
                    swal('请到列表页添加','','warning');
                });
                swal({
                    title: '需要添加二级条码吗？',
                    text: '需要添加二级条码,请在保存后到列表添加！！！',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '添加二级条码',
                    cancelButtonText: '不添加'
                }).then(function (dismiss) {
                    add_form(action, method, form_data+'&procurement_status=unfinished', form_id, location);
                },function () {
                    add_form(action, method, form_data+'&procurement_status='+procurement_status, form_id, location);
                });
                return false;
            }


        } else if (checkError($('#' + form_id)) == "no") {
            return false;
        } else {
            return false;
        }

    });
});


