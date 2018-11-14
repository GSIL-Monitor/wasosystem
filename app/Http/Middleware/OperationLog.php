<?php

namespace App\Http\Middleware;

use Closure;
use Log;
class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        if (app()->environment('production')) {
            $method = $request->method();
            if($request->ajax() || $request->wantsJson()){
                $ip =$request->ip();
                $userString = admin() ?  admin()->account.'-'.admin()->name :'没用登陆IP'.$ip;
                $uri = $request->path();
                $location=geoip($ip);
                $datas=json_encode($request->except(['password','_token','_method']),JSON_UNESCAPED_UNICODE);
                $ipInfo = join(collect($location->toArray())->only(['country','city','state_name','ip'])->all(), ' ');
                $logMsg = join([$userString, $method . ' ' . $uri ,'提交的参数：'.$datas, $ipInfo], ' | ');
                Log::notice($logMsg);
            }
//      }
        return $next($request);
    }
}
