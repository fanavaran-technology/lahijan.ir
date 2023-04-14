<?php

namespace App\Http\Controllers\Clarification;

use App\Http\Controllers\Controller;
use App\Models\Clarification\Investment;
use App\Models\Clarification\InvestmentCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

        if ($requestCategory = request('category')){
            $category = InvestmentCategory::where('title', $requestCategory)->firstOrFail();
            $investments->where('category_id', $category->id);
        }   

        $investments = $investments->with('category')->latest()->paginate(12);

        $categories = InvestmentCategory::all();

        return view('app.clarification.investment', compact('investments', 'categories'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment): View
    {
        return view('app.clarification.show-investment', compact('investment'));
    }


}
