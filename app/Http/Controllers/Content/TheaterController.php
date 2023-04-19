<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use App\Models\Content\Theater;
use Illuminate\Http\Request;

class



TheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theaters = Theater::latest()->where('status' , 1)->paginate(12);
        return view('app.content.theater.index' ,  compact('theaters'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Theater $theater , News $news)
    {
        $latestNews = News::latest()->take(10)->get()->except($news->id);
        return view('app.content.theater.show' , compact('theater' , 'news' , 'latestNews'));
    }

}
