<?php

namespace App\Http\Controllers\FireStation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FireSliderRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\FireSlider;
use App\Models\Content\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FireSliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage_fire_sliders');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fireSliders = FireSlider::query();

        if ($searchString = request('search'))
            $fireSliders->where('alt', "LIKE" , "%{$searchString}%");

        if (request('status'))
            $fireSliders->wherePublished();

        $fireSliders = $fireSliders->latest()->paginate(15);
        return view('admin.content.fire-station.slider.index' , compact('fireSliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.fire-station.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FireSliderRequest $request , ImageService $imageService)
    {
        DB::transaction(function () use($request , $imageService) {
            $inputs = $request->all();

            $publishedAt = substr($inputs['published_at'], 0, -3);
            $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "fire-slider");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $fireSlider = FireSlider::create($inputs);

            Log::info("اسلایدر آتش نشانی با عنوان {$fireSlider->title} توسط {$request->user()->full_name} ایجاد شد.");

        });


        return to_route('admin.content.fire-sliders.index')->with('toast-success' , 'اسلایدر جدید اضافه شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FireSlider $fireSlider)
    {
        return view('admin.content.fire-station.slider.edit' , compact('fireSlider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FireSliderRequest $request, FireSlider $fireSlider, ImageService $imageService)
    {

        DB::transaction(function () use($request , $fireSlider ,$imageService) {
            $inputs = $request->all();

            // set published at
            $publishedAt = substr($inputs['published_at'], 0, -3);
            $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            // save image
            if ($request->hasFile('image')) {
                if (!empty($fireSlider->image))
                    $imageService->deleteImage($fireSlider->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "fire-slider");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            Log::info("اسلایدر آتش نشانی با عنوان {$fireSlider->title} توسط {$request->user()->full_name} ویرایش شد.");

            $fireSlider->update($inputs);
        });

        return to_route('admin.content.fire-sliders.index')->with('toast-success' , 'تغییرات روی اسلایدر اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FireSlider $fireSlider)
    {
        $fireSlider->delete();

        $user = auth()->user()->full_name;

        Log::warning("اسلایدر آتش نشانی با عنوان {$fireSlider->title} توسط {$user} حذف شد.");

        return back()->with('cute-success', 'اسلاید آتش نشانی حذف گردید.');
    }

    public function status(FireSlider $fireSlider)
    {
        $fireSlider->status = $fireSlider->status == 0 ? 1 : 0;
        $result = $fireSlider->save();
        if ($result) {
            if ($fireSlider->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
