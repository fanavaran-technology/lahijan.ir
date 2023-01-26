<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\NewsRequest;
use App\Models\Content\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews = News::latest()->paginate(15);
        return view('admin.content.news.index' , compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        
        DB::transaction(function () use ($request) {
            $inputs = $request->all();
            // temporarily
            // TODO
            $inputs['user_id'] = 1;

            $publishedAt = substr($inputs['published_at'], 0, -3);

            $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            $news = News::create($inputs);

            if ($request->filled('tags')) {
                $tags = explode(',', $request->tags);
                $this->saveTags($news, $tags);
            }
            
        });

        return to_route('admin.content.news.index')->with('toast-success' , 'خبر جدیدی اضافه گردید.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveTags(News $news , Array $tags){

    }
}
