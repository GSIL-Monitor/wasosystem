/**
 * Created by Administrator on 2016/12/23.
 */
$(function () {
    var cptype = $('#peijian_canshu');
    var cplist = $('.cp-list');
    cptype.change(function () {
        //1.获取当前产品类型下拉框所有选中的值
        var cptypeVal = $(this).val();
        //如果值不为空 则向服务器发送请求
        if (cptypeVal != "") {
            //用post给服务器发送信息
            //第一个参数是请求的url 第二个参数是请求发送的数据并且以post发送，第三个参数是回调函数就收返回数据，数据就在函数的参数中
            //第四个参数是请求返回的数据格式默认是html
            if (!cptype.data(cptypeVal)) {
                var cptypeUrl = peiJian_canshu_url;
                $.post(cptypeUrl, {peijian: cptypeVal}, function (data) {
                    cplist.html("");
                    $("<option value='' >请选择产品</option>").appendTo(cplist);
                     $.each(data, function (i, n) {
                      $("<option   value='" + n  + "'>" + i + "</option>").appendTo(cplist);
                       });
                    //把数据缓冲起来，下次从缓冲中去取，取不到的再跟服务器进行交互，取到就直接使用，以此来减轻服务器的压力
                    cptype.data(cptypeVal, data);
                }, "json");
            } else {
                var data = cptype.data(cptypeVal);
                //遍历这个数组元素
                cplist.html("");
                $("<option  value=''>请选择产品</option>").appendTo(cplist);
                                   $.each(data, function (i, n) {
                                       $("<option  value='" + n  + "'>" + i + "</option>").appendTo(cplist);
                                   });
            }
        }
    });
});

