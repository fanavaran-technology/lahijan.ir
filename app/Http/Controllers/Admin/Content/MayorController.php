<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MayorRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Mayor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MayorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mayors = Mayor::query();
        $mayors = $mayors->latest()->paginate(15);
        return view('admin.content.mayor.index' , compact('mayors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.mayor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MayorRequest $request , ImageService $imageService)
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();

            $birthdate = substr($inputs['birthdate'], 0, -3);
            $inputs['birthdate'] = date('Y-m-d H:i:s', $birthdate);

            $recruitment = substr($inputs['recruitment'], 0, -3);
            $inputs['recruitment'] = date('Y-m-d H:i:s', $recruitment);

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'mayors');
                $result = $imageService->save($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.content.mayors.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['image'] = $result;
            }


            $mayor = Mayor::create($inputs);
            Log::info("شهردار با عنوان {$mayor->full_name} توسط {$request->user()->full_name} ایجاد شد.");
        });

        return to_route('admin.content.mayors.index')->with('toast-success' , 'شهردار جدید اضافه گردید.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mayor $mayor)
    {
        return view('admin.content.mayor.edit' , compact('mayor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MayorRequest $request, Mayor $mayor , ImageService $imageService)
    {
        DB::transaction(function () use($request , $mayor , $imageService) {
            $inputs = $request->all();

            $birthdate = substr($inputs['birthdate'], 0, -3);
            $inputs['birthdate'] = date('Y-m-d H:i:s', $birthdate);

            $recruitment = substr($inputs['recruitment'], 0, -3);
            $inputs['recruitment'] = date('Y-m-d H:i:s', $recruitment);

            // save image
            if ($request->hasFile('image')) {
                if (!empty($mayor->image))
                    $imageService->deleteImage($mayor->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "mayors");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $inputs['status'] = $inputs['status'] ?? 0;

            # update check inputs
            $mayor->update($inputs);

            Log::info("شهردار با عنوان {$mayor->full_name} توسط {$request->user()->full_name} ویرایش شد.");
        });

        return to_route('admin.content.mayors.index')->with('toast-success' , 'تغییرات روی مکان گردشگری اعمال شد.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mayor $mayor)
    {

        $mayor->delete();

        $user = auth()->user()->full_name;

        Log::warning("شهردار با عنوان {$mayor->full_name} توسط {$user} حذف شد.");

        return back()->with('toast-success', 'مکان گردشگری حذف گردید.');
    }

    public function status(Mayor $mayor)
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
