<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\NewsRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Gallery;
use App\Models\Content\News;
use App\Models\Content\Tag;
use App\Models\Content\Video;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\Content\NewsGalleryRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage_news');
        $this->middleware('can:edit_news')->only('edit', 'update');
        $this->middleware('can:create_news')->only('store', 'create');
        $this->middleware('can:delete_news')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $allNews = News::query();

        if ($searchString = request('search'))
            $allNews->where('title', "LIKE", "%{$searchString}%");

        if (request('firestation'))
            $allNews->where('is_fire_station', 1);

        if (request('draft'))
            $allNews->where('is_draft', 1);

        if (request('status'))
            $allNews->wherePublished();

        if (request('pin'))
            $allNews->where('is_pined', 1);

        $allNews = $allNews->orderBy('id', 'DESC')->paginate(10);

        return view('admin.content.news.index', compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $videos = Video::all();
        return view('admin.content.news.create', compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request, ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use ($request, $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "news");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            // attach video to news
            if ($request->filled('video')) 
                $inputs['video_id'] = $this->attachVideo($inputs['video']);

            $news = $request->user()->news()->create($inputs);
            
            if ($request->has('galleries')) 
                $this->addImagesToGallery($news, $inputs['galleries'], $inputs['alts']);

            // add tags
            if ($request->filled('tags')) {
                $tags = explode(',', $request->tags);
                $this->saveTags($news, $tags);
            }

            Log::info("خبر با عنوان {$news->title} توسط {$request->user()->full_name} ایجاد شد.");
        });

        return to_route('admin.content.news.index')->with('toast-success', 'خبر جدیدی اضافه گردید.');
    }

    /**
     * ShoShow the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news): View
    {
        $tags = Tag::all()->pluck('title')->implode(',');

        return view('admin.content.news.edit', compact('news', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news, ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use ($request, $news, $imageService) {
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
            $inputs['is_fire_station'] = $inputs['is_fire_station'] ?? 0;
            $inputs['is_auction_tender'] = $inputs['is_auction_tender'] ?? 0;

            // attach video to news
            if ($request->filled('video')) {
                $inputs['video_id'] = $this->attachVideo($inputs['video']);
            }

            $news->update($inputs);

            if ($request->has('galleries')) 
                $this->addImagesToGallery($news, $inputs['galleries'], $inputs['alts']);

            // add tags
            if ($request->filled('tags')) {
                $tags = explode(',', $request->tags);
                $this->saveTags($news, $tags);
            } else if ($news->tags)
                $news->tags()->detach();

            Log::info("خبر با عنوان {$news->title} توسط {$request->user()->full_name} ویرایش شد.");
        });

        return to_route('admin.content.news.index')->with('toast-success', 'تغییرات روی خبر اعمال شد.');
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
            $user = auth()->user()->full_name;
            Log::warning("خبر با عنوان {$news->title} توسط {$user} حذف شد.");
        });

        return back()->with('toast-success', 'خبر حذف گردید.');
    }

    private function attachVideo($videoPath)
    {
        $video = Video::where('video', $videoPath)->first();
        return $video ? $video->id : null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveTags(News $news, array $tags): void
    {
        # remove all news tags
        $news->tags()->detach();
        collect($tags)->map(function ($item) use ($news) {
            # create tag
            $tag = Tag::firstOrCreate([
                'title' => trim($item)
            ]);
            # create article tag
            $news->tags()->attach($tag);
        });
    }

    public function indexGallery(News $news)
    {
        return view("admin.content.news.gallery.index", compact('news'));
    }

    public function createGallery(NewsGalleryRequest $request, News $news, ImageService $imageService)
    {
        $inputs = $request->all();


        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "news-gallery");
            $inputs['image'] = $imageService->save($inputs['image']);
        }

        $news->gallerizable()->create($inputs);

        Log::info("{$request->user()->full_name} تصویری به گالری تصاویر خبر {$news->title} اضافه کرد.");

        return to_route("admin.content.news.index-gallery", $news->id)->with('cute-success', 'تصویر جدید اضافه شد.');
    }

    public function destroyGallery(Gallery $gallery)
    {
        $gallery->delete();

        $user = auth()->user()->full_name;

        Log::warning("{$user} تصویری رااز گالری تصاویر خبر حذف کرد.");
        
        return back()->with('cute-success', 'تصویر حذف گردید.');
    }

    public function draft(News $news)
    {
        $news->is_draft = $news->is_draft == 0 ? 1 : 0;
        $result = $news->save();

        if ($result) {
            if ($news->is_draft == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function pined(News $news)
    {
        $news->is_pined = $news->is_pined == 0 ? 1 : 0;
        $result = $news->save();

        if ($result) {
            if ($news->is_pined == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function uploadVideo(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            throw new \Exception("Error Processing Request", 1);
        }
        // receive file
        $fileReceived = $receiver->receive();

        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();

            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $disk = Storage::disk('videos');
            $jalaliDate = Jalalian::forge(time());
            $path = $jalaliDate->getYear() . '/' . $jalaliDate->getMonth() . '/' . $jalaliDate->getDay();
            $path = $disk->putFileAs($path, $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());

            $finalFilePath = "videos/" . $path;

            Video::create([
                'video' => $finalFilePath
            ]);

            Log::info("{$request->user()->full_name} ویدئوی جدیدی آپلود کرد.");

            return [
                'path' => asset($finalFilePath),
                'filename' => $fileName,
            ];
        }

        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function destroyVideo(News $news) 
    {
        $news->update(['video_id' => null]);
        return back()->with('toast-success', 'ویدئو از خبر حذف گردید.');
    }

    public function addImagesToGallery(News $news, array $galleries, array $alts): void
    {
        $imageService = new ImageService;
        $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "news" . DIRECTORY_SEPARATOR . $news->id);

        $images = [];

        foreach($galleries as $key => $gallery) {
            $imageService->setImageName(Str::random(16));
            $image = $imageService->save($gallery);
            array_push($images, [
                'image'             => $image,
                'alt'               => $alts[$key],
                'gallerizable_type' => get_class($news),
                'gallerizable_id'   => $news->id
            ]);
        }

        $news->gallerizable()->createMany($images);

    }
}
