<?php

namespace App\Http\Controllers\Web;
use App\Models\BusinessManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function about(Request $request)
    {
        $about=BusinessManagement::whereType('about')->first();
        return view('site.abouts.about',compact('about'));
    }
    public function honor(Request $request)
    {
        $honor_tops=BusinessManagement::whereType('honor')->whereTop(true)->get();
        $honors=BusinessManagement::whereType('honor')->whereTop(false)->latest('field->year')->get();
        return view('site.abouts.honor',compact('honors','honor_tops'));
    }

    public function contact(Request $request)
    {
        return view('site.abouts.contact');
    }


}
