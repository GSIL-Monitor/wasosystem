function vee_errors(vee, key, err_msg) {
    var field = vee.$validator.fields.find({name: key, scope: vee.$options.scope});
    if (!field) return;
    vee.$validator.errors.add({
        id: field.id,
        field: key,
        msg: err_msg,
        scope: vee.$options.scope,
    });
}

function isset(arr, name) {
    if (arr.indexOf(name) != -1) {
        return true;
    } else {
        return false;
    }
}

function getToken() {
    return $('meta[name="csrf-token"]').attr('content');
}

function nums(network_mouthLCount, network_mouthTCount, network_mouthGcount, terraceCodeThreeFrist, terraceCodeThreeLast, count) {
    console.log(network_mouthLCount + '-' + network_mouthTCount + '-' + network_mouthGcount + '-' + terraceCodeThreeFrist + '-' + terraceCodeThreeLast + '-' + count);
    if (network_mouthLCount > 0 && terraceCodeThreeFrist == 'L') {
        count = parseInt(network_mouthLCount) + parseInt(terraceCodeThreeLast);
        count = terraceCodeThreeFrist + count;

    } else {
        if (network_mouthLCount > 0) {
            count = 'L' + network_mouthLCount;

        } else {
            if (network_mouthTCount > 0 && terraceCodeThreeFrist == 'T') {
                count = parseInt(network_mouthTCount) + parseInt(terraceCodeThreeLast);
                count = terraceCodeThreeFrist + count;
            } else {
                if (network_mouthTCount > 0) {
                    count = 'T' + network_mouthTCount;
                } else {
                    if (network_mouthGcount > 0 && terraceCodeThreeFrist == 'G') {
                        count = parseInt(network_mouthGcount) + parseInt(terraceCodeThreeLast);
                        count = terraceCodeThreeFrist + count;
                    } else {
                        if (network_mouthGcount > 0) {
                            count = 'G' + network_mouthGcount;
                        } else {
                            count = 'G' + terraceCodeThreeLast;
                        }
                    }
                }
            }
        }
    }
    return count;
}

//整机型号生成
function zheng_JiXingHao_Create() {

    var network_card_code = '', network_mouth = '', network_mouthLCount = 0, network_mouthTCount = 0,
        network_mouthGcount = 0,
        display_cardTotal = 0, mainboardTotal = 0, display_cardNum = 0, mainboardThreeFrist = '',
        mainboardThreeLast = '', mainboardNum = 0, mainboardCode = '', mainboardModel = '', cpuCode = '',
        display_cardCode = '',
        personalityCardFrame = '', personalityCardCode = '', personalityCardNum = 0, terraceCode = '',
        terraceModel = '', raidCard = '', terraceCodeThreeFrist = '',
        terraceCodeThreeLast = '', count = 0, Model = '', terraceOrDisplay_card = '', products = '', frameworks = '',
        crateCode = '', crateTotal = 0, powerCode = '',
        mainboardOrDisplayCard = '', mainboardGtTwo, memoryNum = 0;
    var code = $('.code').val();
    if ($('.listTable').find('.num').length > 0) {
        $.each($('.listTable').find('.num'), function () {
            var product = $(this).find('.good_num');
            var product_name = product.attr('product-name');
            products += product_name + ','
            var product_bianhao = product.attr('product-bianhao');
            var good_id = product.attr('good-id');
            var good_jianma = product.attr('good-jianma');
            var good_framework = product.attr('good-framework');
            frameworks += good_framework + ',';
            var good_num = parseInt(product.val());

            console.log(product_name + '-' + product_bianhao + '-' + good_id + '-' + good_jianma + '-' + good_num);

            if (product_name == '网卡') {
                network_card_code = good_jianma.substr(0, 1);
                network_mouth = good_jianma.substr(1, 1);
                switch (network_card_code) {
                    case 'L':
                        network_mouthLCount += parseInt(network_mouth) * good_num;
                        break;
                    case 'T':
                        network_mouthTCount += parseInt(network_mouth) * good_num;
                        break;
                    case 'G':
                        network_mouthGcount += parseInt(network_mouth) * good_num;
                        break;
                }
                console.log(network_mouthLCount + '-' + network_mouthTCount + '-' + network_mouthGcount);
            }
            if (product_name == '显卡') {
                display_cardTotal += good_num;
                display_cardCode = good_jianma.split(',');
                display_cardNum = display_cardTotal <= 1 ? 0 : display_cardTotal;
            }
            if (product_name == '主板') {
                mainboardTotal += good_num;
                mainboardNum = mainboardTotal <= 1 ? 0 : mainboardTotal;
                mainboardCode = good_jianma.split(',');
                mainboardThreeFrist = mainboardCode[1].substr(0, 1);
                mainboardThreeLast = mainboardCode[1].substr(1, 1);
            }
            if (product_name == 'CPU') {
                cpuCode = good_jianma;
                console.log(cpuCode + 'cpu')
            }
            if (product_name == '机箱') {
                crateCode = good_jianma.split(',');
            }
            if (product_name == '电源') {
                powerCode = good_jianma;
            }

            if (product_name == '内存') {
                memoryNum += parseInt(good_jianma * good_num);
                console.log(memoryNum);
            }
            if (product_name == '专用卡') {
                personalityCardFrame = good_framework;
                personalityCardCode = good_jianma;
                personalityCardNum += good_num;
            }
            if (product_name == '阵列卡') {
                raidCard = good_jianma;
            }
            if (product_name == '平台') {
                terraceCode = good_jianma.split(',');
                terraceCode[4] = terraceCode[4] <= 1 ? 0 : terraceCode[4];
                terraceModel = terraceCode.length == 8 ? '-' + terraceCode[7] : '';
                terraceCodeThreeFrist = terraceCode[3].substr(0, 1);
                terraceCodeThreeLast = terraceCode[3].substr(1, 1);
            }

        })
        console.log(cpuCode + 'cpu')
        if (isset(products, '平台')) {
            count = nums(network_mouthLCount, network_mouthTCount, network_mouthGcount, terraceCodeThreeFrist, terraceCodeThreeLast, count);
            //有平台专用卡情况
            if (isset(products, '专用卡') && isset(frameworks, 'GPU卡') && isset(products, 'CPU')) {
                if (code < 4) {
                    Model = 'N' + '' + personalityCardCode + '' + terraceCode[1] + '' + terraceCode[5] + '' + terraceCode[2] + '-' + '' + cpuCode + '' + count + raidCard + terraceCode[6] + terraceModel;
                } else {
                    Model = 'N' + '' + terraceCode[0] + '' + terraceCode[1] + '' + personalityCardNum + '3' + cpuCode.substr(1, 1) + '-' + '' + memoryNum + '' + count + raidCard + terraceCode[6] + terraceModel;
                }
                $(".name").val(Model);
                console.log(Model + '---1')
                return false;
            }
            //有平台显卡情况
            if (isset(products, '显卡') && isset(products, 'CPU')) {
                if (code < 4) {
                    if (terraceCode[0] == 'G') {
                        terraceOrDisplay_card = terraceCode[0]
                    } else {
                        if (display_cardTotal == 1) {
                            terraceOrDisplay_card = display_cardCode[0];
                            display_cardTotal = 0;
                        } else if (display_cardTotal >= 1) {
                            terraceOrDisplay_card = 'W';
                        } else {
                            terraceOrDisplay_card = terraceCode[0];
                        }
                    }
                    Model = 'N' + '' + terraceOrDisplay_card + '' + terraceCode[1] + '' + display_cardTotal + '' + terraceCode[2] + '-' + '' + cpuCode + '' + count + raidCard + terraceCode[6] + terraceModel;
                } else {
                    Model = 'N' + '' + terraceCode[0] + '' + terraceCode[1] + '' + display_cardTotal + '' + display_cardCode[1] + cpuCode.substr(1, 1) + '-' + '' + memoryNum + '' + count + raidCard + terraceCode[6] + terraceModel;
                }
                $(".name").val(Model);
                console.log(Model + '---2')
                console.log(display_cardTotal)
                return false;
            }
            //有平台情况
            if (isset(products, 'CPU')) {
                if (code < 4) {
                    Model = 'N' + '' + terraceCode[0] + '' + terraceCode[1] + '' + terraceCode[4] + '' + terraceCode[2] + '-' + '' + cpuCode + '' + count + raidCard + terraceCode[6] + terraceModel;
                } else {
                    Model = 'N' + '' + terraceCode[0] + '' + terraceCode[1] + '' + display_cardTotal + '0' + cpuCode.substr(1, 1) + '-' + '' + memoryNum + '' + count + raidCard + terraceCode[6] + terraceModel;
                }
                $(".name").val(Model);
                console.log(Model + '---3')
                return false;
            }
        } else {

            if (mainboardCode.length == 3) {
                mainboardModel = '-' + mainboardCode[2];
            }
            if (mainboardCode['3'] == undefined) {
                mainboardNum = mainboardNum > 1 ? mainboardNum : 0;
            } else {
                mainboardNum = isset(products, '专用卡') ? crateCode[3] : mainboardNum > 1 ? mainboardNum : 0;
            }

            count = nums(network_mouthLCount, network_mouthTCount, network_mouthGcount, mainboardThreeFrist, mainboardThreeLast, count);
            crateTotal = crateCode[2].substr(0, 1) + '' + (eval((parseInt(crateCode[2].substr(1, 1)) + parseInt(mainboardCode[0]))));
            console.log(crateCode);
            //有专用卡情况
            if (isset(products, '专用卡') && isset(frameworks, 'GPU卡') && isset(products, '主板')) {
                if (code < 4)
                    Model = 'N' + '' + personalityCardCode + '' + crateCode[1] + '' + mainboardModel + '' + crateTotal + '-' + '' + cpuCode + '' + count + raidCard + powerCode + mainboardModel;
                else {
                    Model = 'N' + '' + crateCode[0] + crateCode[1] + '' + personalityCardNum + '3' + cpuCode.substr(1, 1) + '-' + '' + memoryNum + '' + count + raidCard + powerCode + mainboardModel;
                }
                $(".name").val(Model);
                console.log(Model + '---1')
                return false;
            }
            //有显卡情况
            if (isset(products, '显卡') && isset(products, '主板')) {
                if (code < 4) {
                    if (crateCode[0] == 'G') {
                        mainboardOrDisplayCard = crateCode[0];
                    } else {
                        if (display_cardTotal == 1) {
                            mainboardOrDisplayCard = display_cardCode[0];
                            display_cardTotal = 0;
                        } else {
                            if (display_cardTotal >= 1) {
                                mainboardOrDisplayCard = 'W';
                            } else {
                                mainboardOrDisplayCard = crateCode[0];
                            }
                        }
                    }
                    console.log(cpuCode + 'cpu')
                    Model = 'N' + '' + mainboardOrDisplayCard + '' + crateCode[1] + '' + display_cardTotal + '' + crateTotal + '-' + '' + cpuCode + '' + count + raidCard + powerCode + mainboardModel;
                    console.log(Model + '11', cpuCode)
                } else {
                    Model = 'N' + '' + 'D' + '' + crateCode[1] + '' + display_cardTotal + '' + display_cardCode[1] + cpuCode.substr(1, 1) + '-' + '' + memoryNum + '' + count + raidCard + powerCode + mainboardModel;
                    console.log(Model + '22')
                }
                $(".name").val(Model);

                console.log(Model + '---2')
                return false;
            }
            //基本情况
            if (isset(products, '机箱') && isset(products, '主板')) {
                if (code < 4) {
                    if (mainboardTotal >= 2) {
                        mainboardGtTwo = 'M';
                    } else {
                        mainboardGtTwo = crateCode[0];
                    }
                    console.log(2)
                    Model = 'N' + '' + mainboardGtTwo + '' + crateCode[1] + '' + mainboardNum + '' + crateTotal + '-' + '' + cpuCode + '' + count + raidCard + powerCode + mainboardModel;
                } else {
                    console.log(1)
                    Model = 'N' + '' + crateCode[0] + '' + crateCode[1] + '00' + cpuCode.substr(1, 1) + '-' + '' + memoryNum + '' + count + raidCard + powerCode + mainboardModel;
                }
                $(".name").val(Model);
                console.log(memoryNum + count + '---3')
                console.log(Model + '---3')
                return false;
            }
        }
    }

}

//二维码生成
function qrcodeCreate() {
    var qrcode = $('.codes').val();
    var options = {
        render: "canvas",
        bgColor: "#ffffff",
        color: "#000000",
        text: qrcode,
    };
    console.log(qrcode);
    $('#qrcode').qrcode(options);
    // $('.ivu-poptip-body-content-inner').qrcode(options);

}


//配置代码生成
function ConfigurationCodeCreate() {
    var code = $('.code').val();
    var str = '';
    $.each($('.listTable').find('.num'), function () {
        var product = $(this).find('.good_num');
        var num = product.val();
        var good_id = product.attr('good-id');
        var product_bianhao = product.attr('product-bianhao');
        good_id = good_id.length == 1 ? '00' + good_id : good_id.length == 2 ? '0' + good_id : good_id
        num = num.length == 1 ? '00' + num : num.length == 2 ? '0' + num : num
        if (num >= 1) //排除捆绑电源
            str += product_bianhao + '' + good_id + num;
    });
    $(".codes").val(code + '' + str)
    return true;
}

//订单含税未税计算
function orderTaxAndNotTax() {
    var order_num = parseInt($('.order_num').val());//订购数
    var service_status = parseInt($('.service_status').val());//服务模式
    var price_spread = parseInt($('.price_spread').val());//差价
    var total_prices = orderMaterialsTaxAndNotTax();
    total_prices = total_prices + price_spread + service_status;//合计
    $('.unit_price').val(total_prices);
    $('.total_prices').val(total_prices * order_num);

}

//订单物料含税未税计算
function orderMaterialsTaxAndNotTax() {
    var tax_point = $('.tax_point').val();//税率
    var invoice_type = $('.invoice_type').val();//开票类型
    var invoice_infos = $('.invoice_infos');//开票信息
    var total_prices = 0, total_price = 0, price = 0, num = 1, good_price = 0;
    $('.product_good_price').each(function () {
        num = $(this).siblings('.num').children('.good_num').val();
        good_price = $(this).attr('data-price');
        if (invoice_type == 'no_invoice') {
            price = Math.ceil(good_price * tax_point);
            invoice_infos.hide().find('.invoice_info').attr('disabled', true);//无需发票 则隐藏发票信息  并且不可提交
        } else {
            price = good_price;
            invoice_infos.show().find('.invoice_info').attr('disabled', false);//非无需发票 显示发票信息  并且可提交
        }
        total_price = parseInt(num * price);
        $(this).text(price);
        $(this).siblings('.total_price').text(total_price);
        total_prices += total_price;//合计
    })
    return total_prices;
}

//toastr 消息提示
function toastrMessage(status, message, location) {

    var url = $(window.parent.frameElement).attr('src');
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "500",
        "timeOut": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[status](message)
    if (url && location == 'top') {
        parent.location.reload();
        // setTimeout(function () {
        //     $(window.parent.frameElement).attr("src", url);
        // }, 500)
    } else if (location == 'static') {
        return;
    } else {
        window.location.reload();
    }
}

//获取选中的checkBox
function getCheckedCheckBox() {
    var ids = [];
    $('.selectIds').each(function () {
        if ($(this).prop('checked')) {
            ids.push($(this).val());
        }
    });
    return ids;
}

function warning(title, str) {
    swal({
        title: title,
        type: 'warning',
        html: $('<div>')
            .addClass('some-class')
            .text(str),
        animation: false,
        customClass: 'animated tada'
    })
}

//Iframe 弹窗
$(function () {
    //复制提交
    $(document).on('click', '.click', function () {
        var url = $(this).attr('data_url');
        var title = $(this).attr('data_title');
        var name = $(this).attr('data_name');
        swal({
            title: title,
            text: '',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '确定' + name,
            cancelButtonText: '取消' + name
        }).then(function (dismiss) {
            axios.get(url)
                .then(function (response) {
                    toastrMessage('success', name + '成功!')
                })
                .catch(function (err) {
                    toastrMessage('error', name + '失败!')
                });
        });
    });
    //复制提交
    $(document).on('click', '.Copy', function () {
        var url = $(this).attr('data_url');
        var csrf_token = getToken();
        swal({
            title: '您确定要复制这条信息吗？',
            text: '操作后将生成一条全新的信息!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '确定复制！',
            cancelButtonText: '取消复制'
        }).then(function (dismiss) {
            axios.post(url, {
                "_token": csrf_token,
                "_method": "post",
            })
                .then(function (response) {
                    toastrMessage('success', '复制成功')
                })
                .catch(function (err) {
                    toastrMessage('error', '复制失败')
                });
        });

    });
    //单个删除提交
    $(document).on('click', '.Del', function () {
        var url = $(this).attr('data_url');
        var id = $(this).attr('data_id');
        var title = $(this).attr('data_title');
        var condition = $(this).attr('data_condition');
        var csrf_token = getToken();
        swal({
            title: '您确定要删除 ' + title + ' <br/>这条信息吗？',
            text: '删除后将无法恢复，请谨慎操作！',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '确定删除！',
            cancelButtonText: '取消删除'
        }).then(function (dismiss) {
            axios.post(url, {
                "_token": csrf_token,
                "_method": "delete",
                "id": id,
                "condition": condition ? condition : ''
            })
                .then(function (response) {
                    toastrMessage('success', '删除成功')
                })
                .catch(function (err) {
                    toastrMessage('error', '删除失败')
                });
        });
    });
    //全部删除提交
    $(document).on('click', '.AllDel', function () {
        var url = $(this).attr('data_url');
        var ids = getCheckedCheckBox();
        var csrf_token = getToken();

        if (ids.length != 0) {
            swal({
                title: '您确定要删除这些信息吗？',
                text: '删除后将无法恢复，请谨慎操作！',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '确定删除！',
                cancelButtonText: '取消删除'
            }).then(function (dismiss) {
                axios.post(url, {
                    "_token": csrf_token,
                    "_method": "delete",
                    "id": ids
                })
                    .then(function (response) {
                        toastrMessage('success', '删除成功')
                    })
                    .catch(function (err) {
                        toastrMessage('error', '删除失败')
                    });
            });
        } else {
            warning('你需要选择删除参数');

        }
    });
    //单个信息添加
    $(document).on('click', '.OneAdd', function () {
        var title = $(this).attr('data_title');
        var product_id = $(this).attr('data_product_id');
        var parent_id = $(this).attr('data_parent_id');
        var url = $(this).attr('data_url');
        var location = $(this).attr('location');
        var csrf_token = getToken();
        swal({
            title: title,
            input: 'text',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: title,
            cancelButtonText: '取消',
            inputValidator: function (value) {
                return new Promise(function (resolve, reject) {
                    if (value) {
                        resolve()
                    } else {
                        reject('你需要输入' + title)
                    }
                })
            }
        }).then(function (name) {
            var csrf_token = getToken();
            axios.post(url, {
                "_token": csrf_token,
                "name": name,
                "product_id": product_id,
                "parent_id": parent_id
            }).then(function (response) {
                console.log(response);
                toastrMessage('success', response.data.info, location)
            })
                .catch(function (err) {
                    console.log(err);
                    toastrMessage('error', '失败', location)
                });
        })
    });
    //公用form表单添加

    //公共添加表单
    $(document).on('click', '.common_add', function () {
        var form_id = $(this).attr('form_id');
        var method = $('#' + form_id).attr('method');
        var action = $('#' + form_id).attr('action');
        var form_data = $('#' + form_id).fixedSerialize();
        var location = $(this).attr('location');

        var url = $(window.parent.frameElement).attr('src');
        if (checkError($('#' + form_id)) == "ok") {
            add_form(action, method, form_data, form_id, location);
        } else if (checkError($('#' + form_id)) == "no") {
            return false;
        } else {
            return false;
        }

    });
    //批量更新表单
    $(document).on('click', '.common_update', function () {
        var form_id = $(this).attr('form_id');
        var method = $('#' + form_id).attr('method');
        var action = $('#' + form_id).attr('action');
        var form_data = $('#' + form_id).fixedSerialize();
        if (!form_data) {
            swal(
                '没有要更新的参数',
                '',
                'warning'
            );
            return false
        } else {
            swal({
                title: '您确定要更新这些信息吗？',
                text: '更新后将无法恢复，请谨慎操作！',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定更新！',
                cancelButtonText: '取消更新'
            }).then(function (dismiss) {
                add_form(action, method, form_data, form_id);
            });
        }
    });
    //select2 多选 加上 multiple="multiple"
    if ($('.select2').length > 0) {
        $('.select2').select2({
            placeholder: '请选择一个',
            // allowClear: true
        });
    }
    //只能输入1以上的数字
    $(document).on('keyup', '.OneNumber', function () {
        var number = $(this).val();
        $(this).val((number > 0) ? number : 1);
    });

    $(document).on('click', '.radio', function () {
        var number = $(this).val();
        $(this).val((number == 0) ? 1 : 0);
    });
});