<?php

namespace App\Http\Controllers\Content;

use App\Models\Content\Video;
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

        $newsQuery = News::query()->latest()->wherePublished();

        $news = [
            'latestNews'    => $newsQuery->take(3)->get(),
            'reportImages'  => $newsQuery->has('gallerizable')->take(5)->get(),
            'newsHasVideo'  => $newsQuery->has('video')->take(5)->get(),
        ];

        $publicCells = PublicCall::latest()->take(2)->where('status' , 1)->get();

        $places = Place::latest()->take(6)->where('status' , 1)->get();

        return view('app.index', compact('sliders' ,'publicCells' , 'places' , 'news'));

    }

}
