/**
 * Created by Administrator on 2016/9/28.
 */
$(document).ready(function(){
    /*   批量修改检查是否为空  */

    function hideError(){       // 清楚错误提示
        $('.ControlBtn .error').text("").hide();
    }

    function checkNum(a){       // 是否为数值
        var s=a.val();
        var reg = new RegExp("^[0-9]*$");
        if(!reg.test(s)){
            a.parents("table").siblings(".ControlBtn").children(".error").text("请输入数值");
            return false;
        }else{
            return true;
        }
    }
    function checkNull(a){   // 判断是否为空
        if(a.val()=="" ||  a.val()==" " ){
            a.parents("table").siblings(".ControlBtn").children(".error").text("不能为空");
            return false;
        }else{
            return true;
        }
    }

    $(document).on("focus",".PLList table tr td input[type='text']",function(){
        hideError();
        $(this).css("border-color","#f5f5f5");
    });

    $(document).on("blur",".PLList table input[type='text']",function(){
       if(checkNull($(this))){
           if(checkNum($(this))){
               hideError();
           }else{
               $(this).parents("table").siblings(".ControlBtn").children(".error").text("请输入数值");
           }
       }else{
           $(this).parents("table").siblings(".ControlBtn").children(".error").text("不能为空");
       }
    });



    /*  提交  */
    $(document).on("click",".batch",function(){
        var vals = $(this).parents(".tableControl").siblings("table").children("tbody").children("tr").children("td").children("input[type='text']");
        var result = "no";
        hideError();
        vals.each(function(){
            if(checkNull(vals)){
                if(checkNum(vals)){
                    result = "ok";
                }else{
                    $(this).css("border-color","#D12E2E");
                    $(this).parents("table").siblings(".ControlBtn").children(".error").show().text("请输入数值");
                    result = "no";
                    return false;
                }
            }else{
                $(this).css("border-color","#D12E2E");
                $(this).parents("table").siblings(".tableControl").children(".ControlBtn").children(".error").show().text("不能为空");
                result = "no";
                return false;
            }
        });

        if(result=="ok"){
            alert("ALLOK");
        }else{
            return false;
        }
    });





})

