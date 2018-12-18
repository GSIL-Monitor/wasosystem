/**
 * Created by Administrator on 2017/1/12.
 */

//检查是否为空
function checkNull(a) {   // 判断是否为空
    if (a.val() == "" || a.val() == " ") {
        a.css("border-color", "#dd4e4e");
        a.parents("li").children(".error").text("不能为空").show();
        return false;
    } else {
        a.css("border-color", "#d6dee3");
        a.parents("li").children(".error").hide();
        return true;
    }
}
//去除数组唯一
function unique(array){
    return array.filter(function(el, index, arr) {
        return index == arr.indexOf(el);
    });
}
function dowfile(dowfile,name) {
    location.href=dowfile_url+'?A='+dowfile+'&B='+name
};
//公共分页切换
function page_content(id) {
    var id = id;
    $.get(page_content_url, {'p': id}, function (data) {
        //用get方法发送信息到Server中的myinfo方法
        $("#page_content").replaceWith(data.content);
    });
}
//公共添加表单
function add_form(e) {
    var add_rule_form = $(".Add_form form").serialize();
    $.post(com_form_url, add_rule_form, function (data) {
        if (data.sta == 'ok') {
            layer.msg(data.info, {icon: 1});
            location.reload(true);
        } else {
            if (data.data) {
                $.each(data.data, function (key, msg) {
                    $(".Add_form select[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
                    $(".Add_form input[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
                });
            }
            if (data.info) {
                layer.msg(data.info, {icon:2});
            }
            return false;
        }
    });
}
//返回状态
function alert_status(data) {
    if (data.sta == 'ok') {
        layer.msg(data.info, {icon: 1});
        location.reload();
    } else {
       layer.msg(data.info, {icon: 2});
    }
}
//返回状态
function alert_statuss(data,type) {
    if (data.sta == 'ok') {
        if (type == 2) {
            layer.msg(data.info, {icon: 1});
            parent.location.reload(true);
        } else {
            layer.msg(data.info, {icon: 2});
            location.reload(true);
        }
    } else {
        if (data.data) {
            $.each(data.data, function (key, msg) {
                $(".Add_form select[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
                $(".Add_form input[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
            });
        }
        if (data.info) {
            layer.msg(data.info, {icon: 2});
        }
        return false;
    }
}
//获取产品
function getchnapins(val) {
    var chanpin_val = val;
    var xilie = $("ul.es-list").eq(1);//获取系列元素

    //如果值不为空 则向服务器发送请求
    if (chanpin_val != "") {
        if (!xilie.data(chanpin_val)) {
            $.get(get_chanpin_url, {"pid": chanpin_val}, function (data) {
                xilie.html("");
                $("<li value=''>请选择产品</li>").appendTo(xilie);
                $.each(data.chanpin, function (i, n) {
                    $("<li value='" + n + "'>" + i + "</li>").appendTo(xilie);
                });
                xilie.data(chanpin_val, data.chanpin);
            }, "json");
        } else {
            var data = xilie.data(chanpin_val);
            //遍历这个数组元素
            xilie.html("");
            $("<li value=''>请选择产品</li>").appendTo(xilie);
            $.each(data, function (i, n) {
                $("<li value='" + n+ "'>" + i + "</li>").appendTo(xilie);
            });
        }
    } else {
        xilie.html("");
        $("<option value=''>请选择产品系列</option>").appendTo(xilie);
    }
}
//公共创建已上传图片
function pics() {
    //产品图 如果大图里面有值  则把图片加到已上传图片
    var pics = $('#pic').val();//获取上传图片
    if (pics) {
        pics = pics.split(';');
        $.each(pics, function (i, n) {
            $('<div style="display: inline-block"><img src="/public/Uploads/' + n + '"  style="width:100px;height: 100px;margin-right: 5px;"><span class="del_btn" data-id="' + n + '">删除</span></div>').appendTo($('.pics'));
        });
    }
}

$(function () {


//返回状态
    function alert_status(data) {
        if (data.sta == 'ok') {
            layer.msg(data.info, {icon: 1});
            location.reload();
        } else {
            layer.msg(data.info, {icon: 2});
        }
    }
    //公共单个删除
    $(document).on('click', ".del", function () {
        var id = $(this).data('id');
        var name=$(this).attr('type')?$(this).attr('type'):'';
        var con=confirm($(this).attr("name"));

        if(con){
            $.get(del_url+name, {"id": id}, function (data) {
                alert_status(data);
            });
        }else{
            return false;
        }

    });
    //公共全部删除
    $(document).on('click', ".AllDel", function () {
        var selectIds = '';
        $.each($('.selectIds:checked'), function () {
            selectIds += $(this).val() + ',';
        });
        selectIds = selectIds.substring(0, selectIds.length - 1);
        if(confirm(($(this).attr("name")))){
            $.post(del_url, {"ids": selectIds}, function (data) {
                alert_status(data);
            });
        }else{
            return false;
        }
    });
    //公共添加表单
    $(document).on('click', ".common_add", function () {
        add_form();
    });

    //订单再次购买
    $(document).on('click', ".copy", function ()  {
        var copyid=$(this).data("id");
        $.post(copy_url, {"id": copyid}, function (data) {
                if (data.sta == 'ok') {
                    layer.msg(data.info,{icon:1});
                    location.reload();
                } else {
                    layer.msg(data.info,{icon:2});
                }
            });
    });


});
