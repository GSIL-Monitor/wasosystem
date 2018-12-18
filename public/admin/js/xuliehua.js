/**
 * Created by Administrator on 2017/3/24.
 */
$.fn.extend({
    "fixedSerialize": function () {
        var $f = $(this);
        var data = $(this).serialize();
        var $chks = $(this).find(":checkbox:not(:checked)");    //取得所有未选中的checkbox
        if ($chks.length == 0) {
            return data;
        }
        var nameArr = [];
        var tempStr = "";
        $chks.each(function () {
            var chkName = $(this).attr("name");
            if ($.inArray(chkName, nameArr) == -1 && $f.find(":checkbox[name='" + chkName + "']:checked").length == 0) {
                nameArr.push(chkName);
                tempStr += "&" + chkName + "=0";
            }
        });
        data += tempStr;
        return data;
    }
});