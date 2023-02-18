<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Models\Content\Slider;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $sliders = Slider::latest()->take(8)->get();

        return view('app.index', compact('sliders'));
        
    }
   
}
