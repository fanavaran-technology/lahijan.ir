<?php

namespace App\Http\Controllers\Admin\Clarification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Clarification\InvestmentRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Clarification\Investment;
use App\Models\Clarification\InvestmentCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $investments = Investment::query();

        if ($searchString = request('search'))
            $investments->where('title', "LIKE" , "%{$searchString}%");

        $investments = $investments->latest()->paginate(15);

        return view('admin.clarification.investment.index', compact('investments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = InvestmentCategory::all();
        return view('admin.clarification.investment.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestmentRequest $request, ImageService $imageService): RedirectResponse
    {
        
        DB::transaction(function () use($request, $imageService) {
            $inputs = $request->all();
            
            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "clarification" . DIRECTORY_SEPARATOR . "investments");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            Investment::create($inputs); 
        });
        
        return to_route('admin.clarification.investments.index')->with('toast-success', 'پروژه جدید اضافه گردید');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment): View
    {
        $categories = InvestmentCategory::all();    
        return view('admin.clarification.investment.edit', compact('investment', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvestmentRequest $request, Investment $investment, ImageService $imageService): RedirectResponse
    {
        DB::transaction(function () use($request, $imageService, $investment) {
            $inputs = $request->all();
            
            // save image
            if ($request->hasFile('image')) {
                if (!empty($investment->image))
                    $imageService->deleteImage($investment->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "clarification" . DIRECTORY_SEPARATOR . "investments");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            $investment->update($inputs); 
        });

        return to_route('admin.clarification.investments.index')->with('toast-success', 'پروژه ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment): RedirectResponse
    {
        $investment->delete();
        return to_route('admin.clarification.investments.index')->with('toast-success', 'پروژه حذف شد');

    }
}
