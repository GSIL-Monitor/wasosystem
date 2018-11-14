<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InDepthCustomizationController extends Controller
{
    public function index(Request $request)
    {

        return view('site.in_depth_customizations.index');
    }



}
