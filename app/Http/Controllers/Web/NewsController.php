<?php

namespace App\Http\Controllers\Web;
use App\Models\BusinessManagement;
use App\Models\InformationManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $type=str_before(str_after($request->url(),'news_'),'.html')    ;
        $news_title=config('site.news_type_cn')[$type];
        $news_type=config('site.news_type_en')[$type];
        $news=InformationManagement::where([
            ['type',$news_type],['marketing->show',1]
        ])->latest()->paginate(10);
        $choiceness_news=InformationManagement::where([
            ['type',$news_type],['marketing->choiceness',1]
        ])->inRandomOrder()->take(5)->get();
        $hot_news=InformationManagement::where([
            ['type',$news_type],['marketing->hot',1]
        ])->inRandomOrder()->take(8)->get();
        return view('site.news.index',compact('news_title','type','news','choiceness_news','hot_news'));
    }
    public function show(Request $request,InformationManagement $informationManagement)
    {
        $informationManagement->visits()->increment();
        $type=array_flip(config('site.news_type_en'))[$informationManagement->type];
        $hot_news=InformationManagement::where([
            ['type',$informationManagement->type],['marketing->hot',1]
        ])->inRandomOrder()->take(10)->get();
        $recommend_news=InformationManagement::where([
            ['type',$informationManagement->type]
        ])->inRandomOrder()->take(3)->get();
        return view('site.news.show',compact('informationManagement','hot_news','type','recommend_news'));
    }

}
