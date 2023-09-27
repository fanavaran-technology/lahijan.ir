<?php

namespace Modules\Complaint\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Complaint\Entities\Complaint;
use Modules\Complaint\Entities\Departement;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $departements = Departement::query();

        $departements = $departements->latest()->paginate(10);


        return view('complaint::admin.department.index' , compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('complaint::admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        Departement::create($inputs);
        return to_route('admin.departements.index')->with('toast-success' , 'دپارتمان جدید ایجاد شد.');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('complaint::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Departement $departement): View
    {
        return view('complaint::admin.department.edit' , compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Departement $departement)
    {
        $inputs = $request->all();
        $departement->update($inputs);
        return to_route('admin.departements.index')->with('toast-success' , 'دپارتمان ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
