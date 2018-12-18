/**
 * Created by Administrator on 2017/5/2.
 */
function webupload_pic(id) {
    var maxsize = 5000;
    $.getScript("webuploader.js", function() {
        if (!WebUploader.Uploader.support()) {
            alert('您的浏览器不支持上传功能！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        }
        var target_id = '#'+id;
        var uploader = WebUploader.create({
            multiple: false,
            auto: true,
            swf: "Uploader.swf",
            server: "ajax.php",
            pick: {
                id: target_id,
                innerHTML: ''
            },
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,png',
                mimeTypes: 'image/*'
            },
            fileSingleSizeLimit: maxsize * 1024 * 1024,
            duplicate: true,
            formData: {
                code: 'identity',
            }

        });
        //上传时
        uploader.on('fileQueued', function(file) {
            var item_progress = "<div class='progress' id='" + file['id'] + "'><span class='bar'></span><span class='percent'>0%</span></div></li>";
            $(".webupload_current").prepend(item_progress);

        });
        //上传中
        uploader.on('uploadProgress', function(file, percentage) {
            var percent = parseFloat(percentage * 100);
            $("#" + file.id).find('.bar').css({"width": percent + "%"});
            $("#" + file.id).find(".percent").text(percent + "%");

        });

        uploader.on('uploadBeforeSend', function(block, data) {
            data.maxsize = maxsize;
        });
        //上传成功后
        uploader.on('uploadSuccess', function(file, response) {
            $(target_id).find(".img_common").remove();
            $(target_id).prepend("<img class='img_common' src=" + "./" + response.pic + " data-pic=" + response.pic + " alt='身份证照片'/>")
        });

        uploader.on('uploadError', function(file, reason) {
            alert("上传失败！请重试。");
        });
    });
}
$(function() {
    webupload_pic('front');

    webupload_pic('back');
});

