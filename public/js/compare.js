/**
 * Created by john on 2016/8/2.
 */
$(document).ready(function() {

    var ScreenW = $(document).width();
    try {
        var navH2 = $(".fixLinks").offset().top;
    }
    catch (e) {
    }
    $(window).scroll(function () {
        try {
            var scroH2 = $(this).scrollTop();
        }
        catch (e) {
        }
        try {
            if (scroH2 >= navH2) {
                $(".fixLinks").css({"position": "fixed", "top": 0, "background": "#fff"}).addClass('shadow_ul');
                if (ScreenW > 900) {
                    $('.fixLinks .price').show();
                    $('.fixLinks .buy_now').show();
                }
            } else if (scroH2 < navH2) {
                $(".fixLinks").css({
                    "position": "static",
                    "border-bottom": "none",
                    "background": "none"
                }).removeClass('shadow_ul')
                $('.fixLinks .price').hide();
                $('.fixLinks .buy_now').hide();
            }
        } catch (e) {
        }
    });
    /*  固定目录 */
});