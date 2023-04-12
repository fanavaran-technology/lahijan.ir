<?php

namespace App\Http\Controllers\Admin\Clarification;

use App\Http\Controllers\Controller;
use App\Models\Clarification\InvestmentCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;


class InvestmentCategoryController extends Controller
{
    private $viewPath = 'admin.clarification.investment.category';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $allCatgeories = InvestmentCategory::query();

        if ($searchString = request('search'))
            $allCatgeories->where('title', "LIKE" , "%{$searchString}%");

        $allCatgeories = $allCatgeories->latest()->paginate(15);

        return view("{$this->viewPath}.index" ,  compact('allCatgeories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view("{$this->viewPath}.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validData = $request->validate([
            'title' =>  'required|min:2|max:255|unique:investment_categories,title'
        ]);

        InvestmentCategory::create($validData);

        return to_route('admin.clarification.categories.index')->with('toast-success', 'دسته بندی جدید ایجاد شد');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestmentCategory $category): View
    {
        return view("{$this->viewPath}.edit", compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestmentCategory $category): RedirectResponse
    {
        $validData = $request->validate([
            'title' => ['required' , Rule::unique('investment_categories', 'title')->ignore($category->id)]
        ]);

        $category->update($validData);

        return to_route('admin.clarification.categories.index')->with('toast-success', 'دسته بندی ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestmentCategory $category): RedirectResponse
    {
        $category->delete();

        return to_route('admin.clarification.categories.index')->with('toast-success', 'دسته بندی حذف گردید');
    }
}
