<?php

namespace App\Http\Controllers\Admin\Content;

use Illuminate\Http\Request;
use App\Models\Content\Slider;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\SliderRequest;
use Illuminate\Support\Facades\URL;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(15);
        return view('admin.content.slider.index' , compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request , ImageService $imageService)
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
        });


        return to_route('admin.content.sliders.index')->with('toast-success' , 'اسلایدر جدید اضافه شد');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
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
    public function update(SliderRequest $request, Slider $slider, ImageService $imageService)
    {

        DB::transaction(function () use($request , $slider ,$imageService) {
            $inputs = $request->all();

            // set published at
            $publishedAt = substr($inputs['published_at'], 0, -3);
            $inputs['published_at'] = date('Y-m-d H:i:s', $publishedAt);

            // save image
            if ($request->hasFile('image')) {
                if (!empty($news->image))
                    $imageService->deleteImage($slider->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "sliders");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

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
    public function destroy(Slider $slider)
    {
        $result = $slider->delete();
        return back()->with('toast-success', 'اسلایدر حذف گردید.');

    }

    public function is_draft(Slider $slider)
    {
        $slider->is_draft = $slider->is_draft == 0 ? 1 : 0;
        $result = $slider->save();
        if ($result) {
            if ($slider->is_draft == 0) {
                return response()->json(['is_draft' => true, 'checked' => false]);
            } else {
                return response()->json(['is_draft' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['is_draft' => false]);
        }
    }
}
