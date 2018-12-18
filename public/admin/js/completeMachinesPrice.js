$(function () {
    create_prices_balance();
    $(document).on("change","#balance",function () {
        var balance= $(this).val();
        if(balance==''){balance=0;}
        balance=parseInt(balance);
        create_prices_balance(balance);
    });
    function create_prices_balance(balance) {
        balance=parseInt($('#balance').val());
        var cost_price=parseInt($("#cost_price").val());
        var core_price=parseInt($("#core_price").val());
        var cooperation_price=parseInt($("#cooperation_price").val());
        var member_price=parseInt($("#member_price").val());
        var retail_price=parseInt($("#retail_price").val());
        var taobao_price=parseInt($("#taobao_price").val());

        $("#cost_price").val(parseInt(cost_price+balance));
        //核心
        $("#core_price").val(parseInt(parseInt(core_price+balance)));
        //合作
        $("#cooperation_price").val(parseInt(parseInt(cooperation_price+balance)));
        //会员
        $("#member_price").val(parseInt(parseInt(member_price+balance)));
        //零售
        $("#retail_price").val(parseInt(parseInt(retail_price+balance)));
        //淘宝
        $("#taobao_price").val(parseInt(parseInt(taobao_price+balance)));
    }
});
