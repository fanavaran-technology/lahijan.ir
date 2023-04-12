<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\BannerTheaterRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\BannerTheater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BannerTheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerTheater = BannerTheater::all();
        return view('admin.content.theater.banner.index' ,  compact('bannerTheater'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerTheater $bannerTheater)
    {
        return view('admin.content.theater.banner.edit' ,  compact('bannerTheater'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerTheaterRequest $request, BannerTheater $bannerTheater , ImageService $imageService)
    {
        DB::transaction(function () use($request , $bannerTheater , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                if (!empty($bannerTheater->image))
                    $imageService->deleteImage($bannerTheater->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "banner-theater");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $inputs['status'] = $inputs['status'] ?? 0;

            # update check inputs
            $bannerTheater->update($inputs);

            Log::info("بنر تئاتر با عنوان {$bannerTheater->title} توسط {$request->user()->full_name} ویرایش شد.");
        });


        return to_route('admin.content.banner-theater.index')->with('toast-success' , 'تغییرات روی بنر تئاتر اعمال شد.');
    }

    public function status(BannerTheater $theater)
    {
        $theater->status = $theater->status == 0 ? 1 : 0;
        $result = $theater->save();
        if ($result) {
            if ($theater->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }



}
