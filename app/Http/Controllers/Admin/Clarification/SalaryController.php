<?php

namespace App\Http\Controllers\Admin\Clarification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clarification\SalaryRequest;
use App\Models\Clarification\Perssonel;
use App\Models\Clarification\SalarySubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_clarification');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $salaries = SalarySubject::query();

        if ($searchString = request('search'))
            $salaries->where('title', "LIKE", "%{$searchString}%");


        $salaries = $salaries->latest()->paginate(15);

        return view('admin.clarification.salary.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $perssonels = Perssonel::all();
        return view('admin.clarification.salary.create', compact('perssonels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalaryRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $inputs = $request->all();

            $salarySubject = SalarySubject::create($inputs);

            $salaries = array_combine($inputs['perssonel_id'], $inputs['amount']);

            foreach ($salaries as $perssonel_id => $amount) {
                echo $perssonel_id;
                $salarySubject->perssonels()->attach($perssonel_id, ['amount' => $amount]);
            }
        });

        return to_route('admin.clarification.salaries.index')->with('toast-success', 'لیست حقوق و دستمزد جدید اضافه شد.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SalarySubject $salary): View
    {
        $perssonels = Perssonel::all();
        return view('admin.clarification.salary.edit', compact('perssonels', 'salary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SalaryRequest $request, SalarySubject $salary): RedirectResponse
    {
        DB::transaction(function () use ($request , $salary) {
            $inputs = $request->all();

            $salary->update($inputs);

            $salaries = array_combine($inputs['perssonel_id'], $inputs['amount']);

            $salary->perssonels()->detach();

            foreach ($salaries as $perssonel_id => $amount) {
                echo $perssonel_id;
                $salary->perssonels()->attach($perssonel_id, ['amount' => $amount]);
            }
        });

        return to_route('admin.clarification.salaries.index')->with('toast-success', 'لیست حقوق و دستمزد جدید اضافه شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalarySubject $salary): RedirectResponse
    {
        $salary->salaries()->detach();

        $salary->delete();

        return back()->with('toast-success' , 'لیست حقوق و دستمزد حذف گردید.');
    }
}
