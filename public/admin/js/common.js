/**
 * Created by Administrator on 2017/1/12.
 */


//分页跳转
function page_go(){
    var url=location.href;
    var val=$('.page_go_num').val();
    var arg='p';
    var pattern = arg+'=([^&]*)';
    var replaceText = arg+'='+val;
    var new_url=url.match(pattern) ? url.replace(eval('/('+ arg+'=)([^&]*)/gi'), replaceText) : (url.match('[\?]') ? url+'&'+replaceText : url+'?'+replaceText);
    location.href=new_url;
}

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



//公共添加表单
function add_form(alerts, type) {
    var add_rule_form = $(".Add_form form").fixedSerialize();
    layer.msg('正在保存中...', {
        icon: 16,shade: 0.01,time:500
    },function(index){
        $.post(add_form_url, add_rule_form, function (data) {
            if (data.sta == 'ok') {
                layer.msg(data.info, {icon: 6});
                if (type == 1) {//子集
                    location.reload();
                } else if (type == 2) {
                    parent.location.reload();
                } else if (type == 3) {
                    location.reload();
                }
            } else {
                if (data.data) {
                    $.each(data.data, function (key, msg) {
                        if (key == 'a16') {
                            $(".Add_form #edui1").css("border-color", "#dd4e4e").show();
                            layer.msg(msg, function () {

                            });
                        }
                        $(".Add_form select[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
                        $(".Add_form input[name='" + key + "']").css("border-color", "#dd4e4e").parent().siblings('.error').text(msg).show();
                    });
                }
                if (data.info) {
                    layer.msg(data.info, function () {

                    });
                }
                return false;
            }
        });
    });

}
//返回状态
function alert_status(data) {
    if (data.sta == 'ok') {
        layer.msg(data.info, {icon:1});
        location.reload(true);
    } else {
        layer.msg(data.info, function () {

        });
    }
}
//返回状态
function alert_statuss(data,type) {
    // layer.load(0, {shade: false});
    if (data.sta == 'ok') {
        if (type == 2) {
            layer.msg(data.info,{icon:1});
            parent.location.reload(true);
        } else {
            layer.msg(data.info,{icon:1});
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
            layer.msg(data.info, function () {});
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
//公用分页  大于10才显示跳转分页的按钮
function check_page() {
    var page_num=$('.page_num').text();
    if(page_num>10){
        $('.page_go').show();
    }else{
        $('.page_go').hide();
    }
}
function jiazai() {
    var index=layer.load(3, {shade: [0.1,'#fff']});

    return index;
}

$(function () {

    check_page();
    // if (top.location !== self.location) {
    //     top.location = lo_url;//跳出框架，并回到首页
    // }
    //修改状态
    $(document).on('click',".status",function () {
        var check=$(this);
        var title=$(this).data('action');
        var id=$(this).data('id');
        var name=$(this).data('field');
        var val=$(this).data('content');
        layer.confirm('<span class="redWord">'+title+'</span>',{btn:['设置','取消']},function () {
            $.get(change_status_url, {"id": id, "status": name,"value":val}, function (data) {
                if (data == 1) {
                    layer.msg("已修改", {icon: 1});
                    location.reload();
                } else {
                    layer.msg("您没有做任何修改", {icon: 2});
                }
            });
        },function (index) {
            if(val==2){
                check.prop('checked',false)
            }else{
                check.prop('checked','checked')
            }
            layer.close(index)
        });

    });
    //公共排序
    $(document).on('click', "#Sort", function () {
        var sort_ids = {};
        $.each($('.Sort'), function () {
            var name = $(this).attr('name');
            var value = $(this).val();
            name && value ? sort_ids[name] = value : '';
        });
        $.post(sort_url, sort_ids, function (data) {
            alert_status(data);
        });
    });
    //公共单个删除
    $(document).on('click', ".del", function () {
        var id = $(this).data('id');
        layer.confirm($(this).attr("name"),{btn:['确定','取消']},function (index) {
            $.get(del_url, {"id": id}, function (data) {
                alert_status(data);
            });
        },function (index) {
            layer.close(index)
            return false;
        });

    });
    //公共全部删除
    $(document).on('click', ".AllDel", function () {
        var selectIds = '';
        $.each($('.selectIds:checked'), function () {
            selectIds += $(this).val() + ',';
        });
        if (selectIds == '') {
            layer.msg("请选择一项删除！",function () {});
            return false;
        }
        layer.confirm("你确定批量删除吗",{btn:['删除','不删除']},function (index) {
            selectIds = selectIds.substring(0, selectIds.length - 1);
            $.post(del_url, {"ids": selectIds}, function (data) {
                alert_status(data);
            });
        },function (index) {
            layer.close(index)
            return false;
        });


    });
    //公共添加表单
    $(document).on('click', ".common_add", function () {

        var alerts = $(this).attr("name");
        var type = $(this).attr("type");
        add_form(alerts,type);

    });
    //获取架构
    $(document).on('change', "select[name='b6']", function () {
        var jiagou = $("select[name='b6']");//获取架构元素
        var xilie = $("select[name='b8']");//获取系列元素
        var xilie_val = $(this).val();
        //如果值不为空 则向服务器发送请求
        if (xilie_val != "") {
            if (!xilie.data(xilie_val)) {
                $.post(get_xilie_url, {"pid": xilie_val}, function (data) {
                    xilie.html("");
                    $("<option value=''>请选择产品系列</option>").appendTo(xilie);
                    $.each(data.xilie, function (i, n) {
                        $("<option value='" + n + "'>" + i + "</option>").appendTo(xilie);
                    });
                    $('input[name="b7"]').val(jiagou.find("option:selected").text());
                    $('input[name="jg"]').val(xilie_val);
                    //把数据缓冲起来，下次从缓冲中去取，取不到的再跟服务器进行交互，取到就直接使用，以此来减轻服务器的压力
                    xilie.data(xilie_val, data.xilie);
                }, "json");
            } else {
                var data = xilie.data(xilie_val);
                //遍历这个数组元素
                xilie.html("");
                $("<option value=''>请选择产品系列</option>").appendTo(xilie);
                $.each(data, function (i, n) {
                    $("<option value='" + n + "'>" + i + "</option>").appendTo(xilie);
                });
                $('input[name="b7"]').val(jiagou.find("option:selected").text());
            }
        } else {
            xilie.html("");
            $("<option value=''>请选择产品系列</option>").appendTo(xilie);
        }
    });
    pics();
    $('.loading').hide();
});
