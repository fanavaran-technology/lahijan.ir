<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use App\Models\Content\PublicCall;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
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

    public function show(PublicCall $publicCall , News $news): View
    {
        $latestNews = News::latest()->take(10)->get()->except($news->id);
        return view('app.content.publicCalls.show' , compact('publicCalls' , 'news' , 'latestNews'));
    }
}
