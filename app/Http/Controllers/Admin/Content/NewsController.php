<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\NewsRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\News;
use App\Models\Content\Tag;
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
    public function store(NewsRequest $request , ImageService $imageService)
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();
            
            // temporarily
            // TODO
            $inputs['user_id'] = 1;

            $publishedAt = substr($inputs['published_at'], 0, -3);
            $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "news");
                $inputs['image'] = $imageService->createIndexAndSave($inputs['image']);
            }

            $news = News::create($inputs);

            // add tags
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
        $tags = Tag::all()->pluck('title')->implode(',');

        return view('admin.content.news.edit', compact('news' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request,News $news , ImageService $imageService)
    {
        DB::transaction(function () use($request , $news , $imageService) {
            $inputs = $request->all();

            // set published at
            $publishedAt = substr($inputs['published_at'], 0, -3);
            $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            // save image
            if ($request->hasFile('image')) {
                if (!empty($news->image['directory']))
                    $imageService->deleteDirectoryAndFiles($news->image['directory']);
                    
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "news");
                $inputs['image'] = $imageService->createIndexAndSave($inputs['image']);
            }
    
            # update check inputs
    
            $news->update($inputs);

            // add tags 
            if ($request->filled('tags')) {
                $tags = explode(',', $request->tags);
                $this->saveTags($news, $tags);
            }
            else if ($news->tags)
                $news->tags()->detach();
        });

        return to_route('admin.content.news.index')->with('toast-success' , 'تغییرات روی خبر اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        DB::transaction(function () use ($news) {
            $news->tags()->detach();
            $news->delete();
        });

        return back()->with('toast-success', 'خبر حذف گردید.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveTags(News $news , Array $tags){
        # remove all news tags
        $news->tags()->detach();
        collect($tags)->map(function($item) use($news){
            # create tag
            $tag = Tag::firstOrCreate([
                'title'  =>   trim($item)
            ]);
            # create article tag
            $news->tags()->attach($tag);
        });
    }
}
