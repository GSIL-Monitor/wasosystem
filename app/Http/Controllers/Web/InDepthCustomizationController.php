<?php

namespace App\Http\Controllers\Web;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InDepthCustomizationController extends Controller
{
    public function index(Request $request)
    {
        $videos=Video::get();
        return view('site.in_depth_customizations.index',compact('videos'));
    }



}
