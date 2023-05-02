<?php

namespace App\Http\Controllers\Content;

use App\Models\Content\BannerTheater;
use App\Models\Content\MayorSpeech;
use App\Models\Content\News;
use App\Models\Content\Place;
use App\Models\Content\Slider;
use App\Models\Content\PublicCall;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $sliders = Slider::latest()->take(8)->where('status' , 1)->get();

        $news = [
            'latestNews'    => News::latest()->wherePublished()->take(5)->get(),
            'newsHasVideo'  => News::latest()->wherePublished()->has('video')->take(5)->get(),
            'reportImages'  => News::latest()->wherePublished()->has('gallerizable')->take(5)->get(),
        ];

        $publicCells = PublicCall::latest()->take(2)->where('status' , 1)->get();

        $places = Place::latest()->take(6)->where('status' , 1)->get();

        $bannerTheater = BannerTheater::latest()->take(1)->where('status' , 1)->get();

        $mayorSpeech = MayorSpeech::latest()->take(1)->where('status' , 1)->get();

        return view('app.index', compact('sliders' ,'publicCells' , 'places' , 'news' , 'bannerTheater' , 'mayorSpeech' ));

    }

}
