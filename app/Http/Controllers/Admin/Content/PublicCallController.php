<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PublicCallRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PublicCall;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PublicCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicCalls = PublicCall::latest()->paginate(15);
        return view('admin.content.public-call.index' , compact('publicCalls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.public-call.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicCallRequest $request , ImageService $imageService)
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();
            
            // temporarily
            // TODO
            $inputs['user_id'] = 1;

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "public-calls");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $publicCall = PublicCall::create($inputs);

            // add tags
            if ($request->filled('tags')) {
                $tags = explode(',', $request->tags);
                $this->saveTags($publicCall, $tags);
            }
            
        });

        return to_route('admin.content.public-calls.index')->with('toast-success' , 'فراخوان جدیدی اضافه گردید.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content\PublicCall  $publicCall
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicCall $publicCall)
    {
        return view('admin.content.public-call.edit', compact('publicCall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content\PublicCall  $publicCall
     * @return \Illuminate\Http\Response
     */
    public function update(PublicCallRequest $request, PublicCall $publicCall , ImageService $imageService)
    {
        DB::transaction(function () use($request , $publicCall , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                if (!empty($publicCall->image))
                    $imageService->deleteImage($publicCall->image);
                    
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "public-calls");
                $inputs['image'] = $imageService->save($inputs['image']);
            }
    
            // update check inputs
            $inputs['status'] = $inputs['status'] ?? 0; 

            $publicCall->update($inputs);
        });

        return to_route('admin.content.public-calls.index')->with('toast-success' , 'تغییرات روی فراخوان اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content\PublicCall  $publicCall
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicCall $publicCall)
    {
        $publicCall->delete();

        return back()->with('toast-success', 'فراخوان حذف گردید.');
    }
}
