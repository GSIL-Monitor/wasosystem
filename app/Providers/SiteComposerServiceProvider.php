<?php

namespace App\Providers;

use App\Http\ViewComposers\SiteComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class SiteComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       View::composer(['site.layouts.default','member_centers.default',
           'site.servers.index'
       ],SiteComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
