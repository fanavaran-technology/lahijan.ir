<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PublicCallRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\PublicCall;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PublicCallController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage_public_cell');
        $this->middleware('can:edit_public_cell')->only('edit', 'update');
        $this->middleware('can:create_public_cell')->only('store', 'create');
        $this->middleware('can:delete_public_cell')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $publicCalls = PublicCall::query();

        if ($searchString = request('search'))
            $publicCalls->where('title', "LIKE" , "%{$searchString}%");

        if (request('status')) 
            $publicCalls->where('status', 1);

        $publicCalls = $publicCalls->latest()->paginate(10);

        return view('admin.content.public-call.index' , compact('publicCalls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.content.public-call.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicCallRequest $request , ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "public-calls");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $publicCall = $request->user()->publicCalls()->create($inputs);

            // add tags
            if ($request->filled('tags')) {
                $tags = explode(',', $request->tags);
                $this->saveTags($publicCall, $tags);
            }
            Log::info("فراخوانی با عنوان {$publicCall->title} توسط {$request->user()->full_name} ایجاد شد.");
            
        });

        return to_route('admin.content.public-calls.index')->with('toast-success' , 'فراخوان جدیدی اضافه گردید.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content\PublicCall  $publicCall
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicCall $publicCall): View
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
    public function update(PublicCallRequest $request, PublicCall $publicCall , ImageService $imageService): RedirectResponse
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
            Log::info("فراخوانی با عنوان {$publicCall->title} توسط {$request->user()->full_name} ویرایش شد.");
        });

        return to_route('admin.content.public-calls.index')->with('toast-success' , 'تغییرات روی فراخوان اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content\PublicCall  $publicCall
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicCall $publicCall): RedirectResponse
    {
        $publicCall->delete();

        $user = auth()->user()->full_name;

        Log::warning("فراخوان با عنوان {$publicCall->title} توسط {$user} حذف شد.");

        return back()->with('toast-success', 'فراخوان حذف گردید.');
    }

    public function status(PublicCall $publicCall)
    {
        $publicCall->status = $publicCall->status == 0 ? 1 : 0;
        $result = $publicCall->save();

        if ($result) {
            if ($publicCall->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
