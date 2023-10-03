<?php

namespace Modules\Complaint\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
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
        $users = User::all();

        $departements = Departement::query();

        $departements = $departements->latest()->paginate(10);


        return view('complaint::admin.department.index' , compact('departements' , 'users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = User::all();
        return view('complaint::admin.department.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $title = $request->input('title');
        if (Departement::where('title', $title)->exists()){
            return to_route('admin.departements.create')->with('cute-success' , 'دپارتمان یا این نام وجود دارد.');
        }else{
            $departements = Departement::create($inputs);
        }

        $inputs['users'] = $inputs['users'] ?? [];
        $departements->users()->sync($inputs['users']);

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
        $users = User::all();
        return view('complaint::admin.department.edit' , compact('departement' , 'users'));
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

        $inputs['users'] = $inputs['users'] ?? [];
        $departement->users()->sync($inputs['users']);

        return to_route('admin.departements.index')->with('toast-success' , 'دپارتمان ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Departement $departement): RedirectResponse
    {
        $departement->users()->detach();
        $departement->delete();
        

        return back()->with('cute-success', 'دپارتمان حذف گردید.');
    }

    public function fetchUser(Departement $departement) {
        
        $departementUsers = $departement->users;

        return response()->json($departementUsers);

    }   
}
