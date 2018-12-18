$(function () {
    $(document).on("click",".PZList li .PZBtn .edit",function(){
        $(this).parents("li").find(".PZName").hide();
        $(this).parents("li").find(".PZNameInput").show();
        $(this).parents(".PZBtn").hide().siblings(".PZEditBtn").show();
    });

    $(document).on("click",".PZList li .PZEditBtn span",function(){
        if($(this).hasClass("sure")){
            var url=$(this).attr("data_url");
            var name=$(this).parents("li").find(".PZNameInput").val();
           axios.post(url,{
            "_method":'PUT',
             "_token":getToken(),
             "name":  name
           }).then(function (response) {
               toastrMessage('success',response.data.info)
           })
               .catch(function (err) {
                   if(err.response.data.info){
                       toastrMessage('error',err.response.data.info)
                   }else{
                       swal(err.response.data.message,
                           '请根据提示操作！',
                           'warning')
                   }
               })
        }
        $(this).parents("li").find(".PZName").show();
        $(this).parents("li").find(".PZNameInput").hide();
        $(this).parents(".PZEditBtn").hide().siblings(".PZBtn").show();
    });
    $(document).on("click",".place_an_order",function(){
        var url=$(this).attr("data_url");
        var title=$(this).attr("data_title");
        swal({
            title: title,
            text: '',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '确定下单！',
            cancelButtonText: '取消下单'
        }).then(function () {
            axios.post(url, {
                "_token": getToken(),
                "_method": "PUT",
            })
                .then(function (response) {
                    swal('下单成功','','success');
                })
                .catch(function (err) {
                    swal('下单成功','','error');
                });
        });
        // axios.post(url,{
        //     "_method":'PUT',
        //     "_token":getToken(),
        //     "name":  name
        // }).then(function (response) {
        //     toastrMessage('success',response.data.info)
        // })
        //     .catch(function (err) {
        //         if(err.response.data.info){
        //             toastrMessage('error',err.response.data.info)
        //         }else{
        //             swal(err.response.data.message,
        //                 '请根据提示操作！',
        //                 'warning')
        //         }
        //     })
    });

});