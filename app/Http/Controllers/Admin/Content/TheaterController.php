<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\TheaterRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Theater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TheaterController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_theater');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theaters = Theater::all();
        return view('admin.content.theater.index' , compact('theaters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.theater.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TheaterRequest $request , ImageService $imageService)
    {
        DB::transaction(function () use($request , $imageService) {
            $inputs = $request->all();
            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "theater");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $theater = Theater::create($inputs);

            Log::info("تئاتر با عنوان {$theater->title} توسط {$request->user()->full_name} ایجاد شد.");

        });

        return to_route('admin.content.theater.index')->with('toast-success', 'تئاتر جدید اضافه گردید.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Theater $theater)
    {
        return view('admin.content.theater.edit', compact('theater'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TheaterRequest $request, Theater $theater , ImageService $imageService)
    {
        DB::transaction(function () use($request , $theater , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                if (!empty($theater->image))
                    $imageService->deleteImage($theater->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "theater");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $inputs['status'] = $inputs['status'] ?? 0;

            # update check inputs
            $theater->update($inputs);

            Log::info("تئاتر با عنوان {$theater->title} توسط {$request->user()->full_name} ویرایش شد.");
        });

        return to_route('admin.content.theater.index')->with('toast-success' , 'تغییرات روی تئاتر اعمال شد.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theater $theater)
    {
        $theater->delete();

        $user = auth()->user()->full_name;

        Log::warning("تئاتر با عنوان {$theater->title} توسط {$user} حذف شد.");

        return back()->with('toast-success', 'تئاتر حذف گردید.');
    }

    public function status(Theater $theater)
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
