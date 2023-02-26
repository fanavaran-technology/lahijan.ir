<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use App\Models\Content\PublicCall;
use Illuminate\Http\Request;

class PublicCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicCalls = PublicCall::latest()->paginate(12);
        return view('app.content.publicCalls.index' ,  compact('publicCalls'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PublicCall $publicCall , News $news)
    {
        $latestNews = News::latest()->take(10)->get()->except($news->id);
        return view('app.content.publicCalls.show' , compact('publicCall' , 'news' , 'latestNews'));
    }
}
