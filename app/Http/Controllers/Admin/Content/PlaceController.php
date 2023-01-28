<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PlaceRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::latest()->paginate(15);
        return view('admin.content.place.index' , compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.place.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request , ImageService $imageService)
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "places");
                $inputs['image'] = $imageService->save($inputs['image']);
            }
            
            Place::create($inputs);
        });

        return to_route('admin.content.places.index')->with('toast-success' , 'مکان گردشگری جدید اضافه گردید.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        return view('admin.content.place.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceRequest $request, Place $place , ImageService $imageService)
    {
        DB::transaction(function () use($request , $place , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                if (!empty($place->image))
                    $imageService->deleteImage($place->image);
                    
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "places");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $inputs['status'] = $inputs['status'] ?? 0;
    
            # update check inputs
            $place->update($inputs);
        });

        return to_route('admin.content.places.index')->with('toast-success' , 'تغییرات روی مکان گردشگری اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();
        return back()->with('toast-success', 'مکان گردشگری حذف گردید.');
    }
}
