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
use Modules\Complaint\Http\Requests\DepartmentRequest;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('complaint::admin.department.index');
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
    public function store(DepartmentRequest $request): RedirectResponse
    {
        $inputs = $request->all();
        $departements = Departement::create($inputs);

        $inputs['users'] = $inputs['users'] ?? [];
        $departements->users()->sync($inputs['users']);

        return to_route('admin.departements.index')->with('toast-success' , 'دپارتمان جدید ایجاد شد.');
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
    public function update(DepartmentRequest $request, Departement $departement): RedirectResponse
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

    public function fetch()
    {
        $departements = Departement::query()->select('id', 'title', 'description');
        
        if ($search = request('search')) {
            $departements->where("title", 'LIKE', "%{$search}%")->orWhere('description', "LIKE", "%{$search}%");
        }
        
        $departements = $departements->latest()->paginate(10);
        return response()->json($departements);

    }

    public function fetchUser(Departement $departement) {
        
        $departementUsers = $departement->users;

        return response()->json($departementUsers);

    } 

}
