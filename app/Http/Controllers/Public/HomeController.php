<?php

namespace App\Http\Controllers\Public;

use Carbon\Carbon;
use App\Models\Content\Menu;
use App\Models\Content\News;
use Illuminate\Http\Request;
use App\Models\Content\Place;
use App\Models\Content\Slider;
use App\Models\Content\PublicCall;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $sliders = Slider::latest()->take(8)->where('status' , 1)->get();

        $latestNews = News::latest()->take(3)->wherePublished()->get();

        $reportImages = News::has('gallerizable')->latest()->take(5)->wherePublished()->get();

        $publicCells = PublicCall::latest()->take(2)->where('status' , 1)->get();

        $places = Place::latest()->take(6)->where('status' , 1)->get();

        $menus = Menu::latest()->take(15)->get();





        return view('app.index', compact('sliders' , 'latestNews' , 'publicCells' , 'places' , 'reportImages' ));

    }

}
