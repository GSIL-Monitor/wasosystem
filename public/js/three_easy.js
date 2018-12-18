/**
 * Created by 821 on 2018/4/24.
 */
var windowW = $(document).width();


function tableInfoDetail(){
    $(".listTable tr").each(function(){
        $(this).find(".tableName").prepend("<i class='tableDetailBtn tableOpenBtn' title='展开详情'></i>");
    });

}
function active() {
    $('i[data_order="'+sort+'"]').parents("th").addClass("activeTh").siblings("th").removeClass("activeTh");
    $('i[data_order="'+sort+'"]').parents("th").siblings("th").find('i').removeClass("active");
    $('i[data_order="'+sort+'"]').addClass("active").siblings("i").removeClass("active");
}
function checkWidth(){
    if(windowW>900){
        var tableThHeight = $(".tableTh:visible").offset().top;
        var tableThLeft = $(".tableTh:visible").offset().left;
        var tableWidth = $(".tableTh:visible").width();
        $(".listTable th,td").each(function(){
            var index = $(this).index();
            var thWidth = $(".listTable tr").eq(1).find("td").eq(index).width();
            $(this).css("width",thWidth);
        });

        $(window).scroll(function(){
            var windowTop = $(window).scrollTop();
            if(windowTop>=tableThHeight){
                $(".listTable:visible").css("margin-top","50px");
                $(".listTable:visible .tableTh").addClass("fixedTh").css({"left":""+tableThLeft+"","width":""+tableWidth+""});
            }else{
                $(".listTable:visible").css("margin-top","0");
                $(".listTable:visible .tableTh").removeClass("fixedTh").css({"margin-left":"0"});
            }
        });
    }
}

$(document).ready(function(){

    checkWidth();


    $(document).on("click",".listTable .paiIcon i",function(){
        var good=$(this).attr('good');
        var order=$(this).attr('order');
        axios.post(order_url,{
            "type":good,
            "order":order,
            "_token":getToken(),
            "method":'POST'
        }).then(function (response) {
            $(".Content").html(response.data);
            $('i[order="'+order+'"]').parents("th").addClass("activeTh").siblings("th").removeClass("activeTh");
            $('i[order="'+order+'"]').parents("th").siblings("th").find('i').removeClass("active");
            $('i[order="'+order+'"]').addClass("active").siblings("i").removeClass("active");
            checkWidth();
        }).catch(function (err) {
            if(err.response.data.message !=undefined){
                swal(err.response.data.message,'请根据提示操作','error')
            }
        })
    });


    $(document).on("click",".listTable .thTxt",function(){
        var obj = $(this).parents("th");
        if(obj.hasClass("activeTh")){
            $(this).siblings(".paiIcon").find(".active").siblings("i").trigger("click");
        }else{
            $(this).siblings(".paiIcon").find("i").eq(1).trigger("click");
        }
    });


 
    if(windowW<=900){
        tableInfoDetail();
    }

    $(document).on("click",".ZBtype li",function(){
        var index = $(this).index();
        var good=$(this).attr('good');
        axios.post(order_url,{
            "type":good,
            "_token":getToken(),
            "method":'POST'
        }).then(function (response) {
            $(".Content").html(response.data);
            $(".ZBtype li[good='"+good+"']").addClass("active").siblings("li").removeClass("active");
            $(".ZBtype li[good='"+good+"']").eq(index).addClass("activeTable").siblings(".tablePage").removeClass("activeTable");
            checkWidth();
        }).catch(function (err) {
            if(err.response.data.message !=undefined){
                swal(err.response.data.message,'请根据提示操作','error')
            }
        })
    });


    $(document).on("click",".listTable .tableOpenBtn",function(){
        var tdLength = $(this).parents("tr").find("td").length;
        var thNum = 0;
        var trNum = 0;
        $(this).parents(".listTable").find(".detailTableTr").remove();
        $(this).parents("tr").addClass("showTr").siblings("tr").removeClass("showTr");
        $(this).parents(".listTable").find(".tableCloseBtn").removeClass("tableCloseBtn").addClass("tableOpenBtn");
        $(this).addClass("tableCloseBtn").removeClass("tableOpenBtn").attr("title","收起详情");
        $(this).parents(".listTable").find(".showTr").after("<tr class='detailTableTr'><td colspan='"+tdLength+"'><div class='detailTable'></div></td></tr>");
        $(this).parents("td").siblings("td:not('.tableInfoDel')").each(function(){
            $(this).attr("num",trNum);
            $(this).parents(".listTable").find(".detailTable").append("<div class='detaileLine' name='"+trNum+"'><div class='detailName' ></div><div class='detailContent'></div></div>");
            $(this).parents(".listTable").find(".detailTable").find(".detaileLine[name='"+trNum+"']").children(".detailContent").append($(this).html());
            trNum +=1;
        });
        $(this).parents(".listTable").find("th:not('.tableInfoDel')").each(function(){
            $(this).attr("num",thNum);
            $(".detailTable").find(".detaileLine[name='"+thNum+"']").children(".detailName").prepend($(this).html());
            thNum +=1;
        });
    });

    $(document).on("click",".listTable .tableCloseBtn",function(){
        $(this).addClass("tableOpenBtn").removeClass("tableCloseBtn").attr("title","展开详情");
        $(this).parents("tr").removeClass(".showTr").siblings(".detailTableTr").remove();
    });
});

