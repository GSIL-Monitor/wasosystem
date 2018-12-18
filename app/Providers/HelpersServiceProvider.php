<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       //将读取的集合多为数组以符号拼接
        Collection::macro('field',function($data=[],$separator=","){
            return $this->map(function ($value) use ($data,$separator){
              return implode($separator,$value->only($data));
            });
        });
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
