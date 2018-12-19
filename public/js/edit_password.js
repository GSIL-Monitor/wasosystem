var vm = new Vue({
    el: "#app",
    data: {
        old_password: '',
        password: '',
        password_confirmation: '',
    },
    methods: {
        save: function (url) {
            var self=this;
            this.$validator.validateAll().then(function (msg) {
                if (msg) {
                    axios.put(url, {
                        '_token': getToken(),
                        'password': self.password
                    }).then(function (response) {
                        swal(response.data.info,
                            '请根据提示操作！',
                            'success').then(function () {
                            location.reload();
                        })
                    }).catch(function (err) {
                        swal(err.response.data.message,
                            '请根据提示操作！',
                            'error');

                    });
                }
            });
        }
    }
});