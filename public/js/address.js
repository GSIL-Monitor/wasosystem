var vm = new Vue({
    el: "#app",
    data: {
        info: {
            'number': 'A',
            'tax_mode': 'vat_special_invoice'
        },
        create_edit: false,
        title: ''
    },
    methods: {
        set_default: function (url) {
            axios.post(url, {
                "_token": getToken(),
                '_method': 'PUT'
            }).then(function (response) {
                toastrMessage('success', response.data.info)
            }).catch(function (err) {
                swal(err.response.data.message,
                    '请根据提示操作！',
                    'warning')
            });
        },
        create: function () {
            this.create_edit = true;
            this.title = '添加';
            this.info = {'number': 'A', 'tax_mode': 'vat_special_invoice'}
        },
        edit: function (url) {
            var self = this;
            axios.get(url, {
                "_token": getToken()
            }).then(function (response) {
                self.info = response.data;
                self.create_edit = true;
                self.title = '修改  ' + response.data.name + '  ';
            }).catch(function (err) {
                swal(err.response.data.message,
                    '请根据提示操作！',
                    'warning')
            });

        },
        cancel: function () {
            this.create_edit = false;
        },
        save: function () {
            var action = $('#address').attr('action');
            var self=this;
            this.$validator.validateAll().then(function (msg) {
                if (msg) {
                    axios.post(action,{
                        "_token":getToken(),
                        'info':self.info
                    }).then(function (response) {
                        toastrMessage('success', response.data.info)
                    }).catch(function (err) {
                        if (err.response.data.info) {
                            toastrMessage('error', err.response.data.info)
                        }
                        if (err.response.data.errors != undefined) {
                            $.each(err.response.data.errors, function (name, errMsg) {
                                vee_errors(self,name,errMsg[0])
                            });
                        } else {
                            swal(err.response.data.message,
                                '请根据提示操作！',
                                'warning')
                        }
                    });
                }
            });
        }

    },
    mounted: function () {
    }
});
$(function () {
    $(document).on('click', '.addreses .change_view', function () {
        $(this).parent('.tr').siblings().find('dl').hide();
        $(this).siblings('.LikeBtn').toggle();
    })
});