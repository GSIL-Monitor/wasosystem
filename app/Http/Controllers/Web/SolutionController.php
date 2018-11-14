<?php

namespace App\Http\Controllers\Web;
use App\Models\Integration;
use App\Models\IntegrationCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $integrations=IntegrationCategory::with('child')->get();
        return view('site.solutions.index',compact('integrations'));
    }
    public function show(Request $request,Integration $integration)
    {

        $integration->load('parent','parent.child');
        return view('site.solutions.show',compact('integration'));
    }


}
