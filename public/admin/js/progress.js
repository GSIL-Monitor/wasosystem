function progress_bar() {
    /* 百分比  */
    $(".JDBox").each(function () {
        if ($(this).find(".goal").eq(0).children("i").text() == '') {
            var goal = 0;
        } else {
            var goal = parseInt($(this).find(".goal").eq(0).children("i").text());
        }
        if ($(this).find(".guaranteed_task").eq(0).children("i").text() == '') {
            var guaranteed_task = 0;
        } else {
            var guaranteed_task = parseInt($(this).find(".guaranteed_task").eq(0).children("i").text());
        }
        if ($(this).find(".returned_money").eq(0).children("i").text() == '') {
            var returned_money = 0;
        } else {
            var returned_money = parseInt($(this).find(".returned_money").eq(0).children("i").text());
        }
        if(guaranteed_task && guaranteed_task && goal){
            var Percentguaranteed_task = parseFloat(guaranteed_task / goal).toFixed(2) * 100 + "%";
            var Percentreturned_money = parseFloat(returned_money / goal).toFixed(2) * 100 + "%"
        }else{
            var Percentreturned_money="100%"
        }
        if (!goal && !guaranteed_task && returned_money) {
            $(this).find(".returned_money").addClass("yellow");
        }
        $(this).find(".guaranteed_task").css("width", Percentguaranteed_task);
        $(this).find(".returned_money").css("width", Percentreturned_money);
    });
}

function member() {
    $(".member").each(function () {
        var goal = parseInt($(this).find(".goal").eq(0).children("i").text());
        var guaranteed_task = parseInt($(this).find(".guaranteed_task").eq(0).children("i").text());
        var returned_money = parseInt($(this).find(".returned_money").eq(0).children("i").text());
        var monthly_sales = parseInt($(this).find(".monthly_sales").text());
        var outstanding = parseInt($(this).find(".outstanding").text());
        var pid = $(this).attr('data-pid');

        if (!goal && !guaranteed_task && !returned_money && !monthly_sales && !outstanding) {
            $(this).hide();
            var id = $(this).attr('data-id');
            $('.list_'+id).hide();
            /*为0隐藏*/
        }
        var parent = $('.parent_' + pid).find(".returned_money").eq(0).children("i");
        var parent_returned_money=$('.parent_' + pid).find(".YHIWords");
        var parent_monthly_sales = $('.parent_' + pid).find(".monthly_sales");
        var parent_outstanding = $('.parent_' + pid).find(".outstanding");
console.log(returned_money);
        parent.text(returned_money + parseInt(parent.text()))
        parent_returned_money.text(returned_money + parseInt(parent.text()));
        parent_monthly_sales.text(monthly_sales + parseInt(parent_monthly_sales.text()));
        parent_outstanding.text(outstanding + parseInt(parent_outstanding.text()));
    });
}
function group() {
    $(".group").each(function () {
        var goal = parseInt($(this).find(".goal").eq(0).children("i").text());
        var guaranteed_task = parseInt($(this).find(".guaranteed_task").eq(0).children("i").text());
        var returned_money = parseInt($(this).find(".returned_money").eq(0).children("i").text());
        var monthly_sales = parseInt($(this).find(".monthly_sales").text());
        var outstanding = parseInt($(this).find(".outstanding").text());
        var pid = $(this).attr('data-pid');
        if (!goal && !guaranteed_task && !returned_money && !monthly_sales && !outstanding) {
            $(this).hide();
            var id = $(this).attr('data-id');
            $('.list_'+id).hide();
            /*为0隐藏*/
        }
        var parent = $('.parent_' + pid).find(".returned_money").eq(0).children("i");
        var parent_returned_money=$('.parent_' + pid).find(".YHIWords");
        var parent_monthly_sales = $('.parent_' + pid).find(".monthly_sales");
        var parent_outstanding = $('.parent_' + pid).find(".outstanding");

        parent.text(returned_money + parseInt(parent.text()))
        parent_returned_money.text(returned_money + parseInt(parent.text()));
        parent_monthly_sales.text(monthly_sales + parseInt(parent_monthly_sales.text()));
        parent_outstanding.text(outstanding + parseInt(parent_outstanding.text()));
    });
}
function department() {
    $(".department").each(function () {
        var goal = parseInt($(this).find(".goal").eq(0).children("i").text());
        var guaranteed_task = parseInt($(this).find(".guaranteed_task").eq(0).children("i").text());
        var returned_money = parseInt($(this).find(".returned_money").eq(0).children("i").text());
        var monthly_sales = parseInt($(this).find(".monthly_sales").text());
        var outstanding = parseInt($(this).find(".outstanding").text());
        var pid = $(this).attr('data-pid');
        if (!goal && !guaranteed_task && !returned_money && !monthly_sales && !outstanding) {
            $(this).hide();
            var id = $(this).attr('data-id');
            $('.list_'+id).hide();
            /*为0隐藏*/
        }
        var parent = $('.parent_' + pid).find(".returned_money").eq(0).children("i");
        var parent_returned_money = $('.parent_' + pid).find(".YHIWords");
        var parent_monthly_sales = $('.parent_' + pid).find(".monthly_sales");
        var parent_outstanding = $('.parent_' + pid).find(".outstanding");
        parent.text(returned_money + parseInt(parent.text()))
        parent_returned_money.text(returned_money + parseInt(parent.text()));
        parent_monthly_sales.text(monthly_sales + parseInt(parent_monthly_sales.text()));
        parent_outstanding.text(outstanding + parseInt(parent_outstanding.text()));
    });
}
function get_data(a) {
    var url=a.attr('data_url');
    axios.get(url,{"_token":getToken()}) .then(function (response) {
             $('#bing').html(response.data);
                member();
                group();
                department();
                progress_bar();
                  hideLoading();
    }).catch(function (error) {
            console.log(error);
   });
}



$(function () {
    member();
    group();
    department();

    $(document).on('click','.task_managements',function () {
        $('.PersonInfo dd a').removeClass("active");
        $(this).addClass('active')
        showLoading();
        get_data($(this))
    });
    progress_bar();
});

