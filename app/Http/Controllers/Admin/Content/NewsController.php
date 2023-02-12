<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\NewsRequest;
use App\Http\Services\Image\ImageService;
use App\Imports\NewsImageImport;
use App\Imports\NewsImport;
use App\Models\Content\News;
use App\Models\Content\Tag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\NewsImage;
use Symfony\Component\HttpFoundation\RedirectResponse;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $allNews = News::query();

        if ($searchString = request('search'))
            $allNews->where('title', "LIKE" , "%{$searchString}%");

        if (request('firestation')) 
            $allNews->where('is_fire_station', 1);

        if (request('draft')) 
            $allNews->where('is_draft', 1);

        if (request('status'))
            $allNews->wherePublished();

        if (request('pin')) 
            $allNews->where('is_pined', 1);

        $allNews = $allNews->orderBy('id' , 'DESC')->paginate(10);

        return view('admin.content.news.index' , compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.content.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request , ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "news");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $news = $request->user()->create($inputs);

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
    public function edit(News $news): View
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
    public function update(NewsRequest $request,News $news , ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use($request , $news , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                if (!empty($news->image['directory']))
                    $imageService->deleteImage($news->image);
                    
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "news");
                $inputs['image'] = $imageService->save($inputs['image']);
            }
    
            // update check inputs
            $inputs['is_draft'] = $inputs['is_draft'] ?? 0; 
            $inputs['is_pined'] = $inputs['is_pined'] ?? 0; 
            $inputs['is_fire_station'] = $inputs['is_draft'] ?? 0; 

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
    public function destroy(News $news): RedirectResponse
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
    public function saveTags(News $news , Array $tags): void
    {
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
