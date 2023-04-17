<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MayorSpeechRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\MayorSpeech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MayorSpeechController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_mayor_speech');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mayorSpeech = MayorSpeech::all();
        return view('admin.content.mayor-speech.index' , compact('mayorSpeech'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MayorSpeech $mayorSpeech)
    {
        return view('admin.content.mayor-speech.edit' , compact('mayorSpeech'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MayorSpeechRequest $request, MayorSpeech $mayorSpeech , ImageService $imageService)
    {
        DB::transaction(function () use($request , $mayorSpeech , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                if (!empty($mayorSpeech->image))
                    $imageService->deleteImage($mayorSpeech->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "mayor-speech");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $inputs['status'] = $inputs['status'] ?? 0;

            # update check inputs
            $mayorSpeech->update($inputs);

            Log::info("سخن شهردار با عنوان {$mayorSpeech->full_name} توسط {$request->user()->full_name} ویرایش شد.");
        });

        return to_route('admin.content.mayor-speech.index')->with('toast-success' , 'تغییرات روی سخن شهردار اعمال شد.');
    }

    public function status(MayorSpeech $mayor)
    {
        $mayor->status = $mayor->status == 0 ? 1 : 0;
        $result = $mayor->save();

        if ($result) {
            if ($mayor->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
