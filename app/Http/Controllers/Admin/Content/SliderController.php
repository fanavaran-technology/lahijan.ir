<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Slider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\SliderRequest;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage_sliders');
        $this->middleware('can:edit_slider')->only('edit', 'update' , 'status');
        $this->middleware('can:delete_slider')->only('store', 'create');
        $this->middleware('can:create_slider')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $sliders = Slider::query();

        if ($searchString = request('search'))
            $sliders->where('alt', "LIKE" , "%{$searchString}%");

        if (request('status'))
            $sliders->wherePublished();

        $sliders = $sliders->latest()->paginate(15);
        return view('admin.content.slider.index' , compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.content.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request , ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use($request , $imageService) {
            $inputs = $request->all();

            $publishedAt = substr($inputs['published_at'], 0, -3);
                $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "slider");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $slider = Slider::create($inputs);

            Log::info("اسلایدر با عنوان {$slider->title} توسط {$request->user()->full_name} ایجاد شد.");

        });


        return to_route('admin.content.sliders.index')->with('toast-success' , 'اسلایدر جدید اضافه شد');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider): View
    {
        return view('admin.content.slider.edit' , compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider, ImageService $imageService): RedirectResponse
    {

        DB::transaction(function () use($request , $slider ,$imageService) {
            $inputs = $request->all();

            // set published at
            $publishedAt = substr($inputs['published_at'], 0, -3);
            $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            // save image
            if ($request->hasFile('image')) {
                if (!empty($slider->image))
                    $imageService->deleteImage($slider->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "slider");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            Log::info("اسلایدر با عنوان {$slider->title} توسط {$request->user()->full_name} ویرایش شد.");

            $slider->update($inputs);
        });

        return to_route('admin.content.sliders.index')->with('toast-success' , 'تغییرات روی اسلایدر اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider): RedirectResponse
    {
        $slider->delete();

        $user = auth()->user()->full_name;

        Log::warning("اسلایدر با عنوان {$slider->title} توسط {$user} حذف شد.");

        return back()->with('cute-success', 'اسلاید حذف گردید.');
    }

    public function status(Slider $slider)
    {
        $slider->status = $slider->status == 0 ? 1 : 0;
        $result = $slider->save();
        if ($result) {
            if ($slider->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
