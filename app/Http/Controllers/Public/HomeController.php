<?php

namespace App\Http\Controllers\Public;

use App\Models\Content\Menu;
use App\Models\Content\News;
use App\Models\Content\Place;
use App\Models\Content\PublicCall;
use Illuminate\Http\Request;
use App\Models\Content\Slider;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $sliders = Slider::latest()->take(8)->where('status' , 1)->get();

        $latestNews = News::latest()->take(3)->where('is_draft' , 0)->get();

        $publicCells = PublicCall::latest()->take(2)->where('status' , 1)->get();

        $places = Place::latest()->take(6)->where('status' , 1)->get();

        $reportImages = News::latest()->take(15)->where('is_draft' , 0)->get();

        $menus = Menu::latest()->take(15)->get();



        return view('app.index', compact('sliders' , 'latestNews' , 'publicCells' , 'places' , 'reportImages' ));

    }

}
