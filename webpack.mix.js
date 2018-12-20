let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .scripts([
        'public/js/mediaqueries.js',
        'public/js/jquery-1.7.2.min.js',
        'public/js/animate-colors-min.js',
        'public/js/jquery.qrcode.min.js',
        'public/js/public.js',
        'public/js/sweetalert2.js',
        'public/js/jquery.lazyload.js',
        'public/admin/js/toastr.min.js',
        'public/admin/js/xuliehua.js',
        'public/admin/js/axios.min.js',
        'public/admin/js/checkForm.js',
        'public/talk.js',
        'public/admin/js/ws.js',
        'public/js/app.js',
    ], 'public/common/frontend.js')
    .scripts([
        'public/admin/js/jquery-2.1.1.min.js',
        'public/admin/js/xuliehua.js',
        'public/admin/js/pagePublic.js',
        'public/admin/js/toastr.min.js',
        'public/js/sweetalert2.js',
        'public/admin/js/core.min.js',
        'public/admin/js/axios.min.js',
        'public/admin/js/select2.min.js',
        'public/admin/js/jquery.qrcode.min.js',
        'public/admin/js/checkForm.js',
        'public/admin/js/ws.js',
        'public/js/app.js',
    ], 'public/admin/common/backend.js')
    .scripts([
        'public/admin/js/jquery-2.1.1.min.js',
        'public/admin/js/public.js',
        'public/admin/js/jquery.rotate.min.js',
    ], 'public/admin/common/backend_index.js')
    .styles([
        'public/styles/iview.css',
        'public/css/public.css',
        'public/css/update.css',
        'public/admin/css/select2.min.css',
        'public/css/sweetalert2.css',
        'public/admin/css/toastr.min.css',
        'public/css/register.css',
        'public/css/login.css',
    ], 'public/common/frontend.css')
    .styles([
        'public/styles/iview.css',
        'public/admin/css/animate.min.css',
        'public/admin/css/public.css',
        'public/admin/css/sweetalert.css',
        'public/css/sweetalert2.css',
        'public/admin/css/toastr.min.css',
        'public/admin/css/select2.min.css',
        'public/admin/css/common.css',
        'public/admin/css/login.css',
    ], 'public/admin/common/backend.css')
    .styles([
        'public/admin/css/public.css',
        'public/admin/css/icons.css',
        'public/admin/css/update.css',
    ], 'public/admin/common/backend_index.css')
    .version();
