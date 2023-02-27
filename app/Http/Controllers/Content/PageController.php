<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use App\Models\Content\Page;
use App\Models\Content\Place;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Page $page,  News $news , Place $places)
    {
        $places = Place::latest()->take(3)->get()->except($places->id);

        $latestNewsPage = News::latest()->take(3)->get()->except($news->id);

        return view('app.page' , compact('page' , 'latestNewsPage' , 'places'));
    }
}
