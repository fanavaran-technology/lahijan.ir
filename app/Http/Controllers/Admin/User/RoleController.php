<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\ACL\Role;
use Illuminate\Http\RedirectResponse;
use App\Models\ACL\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_roles');
        $this->middleware('can:edit_roles')->only('edit', 'update');
        $this->middleware('can:create_roles')->only('store', 'create');
        $this->middleware('can:delete_roles')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $roles = Role::query();

        if ($keyword = request('search')) 
            $roles->where('title' , "LIKE" , "%{$keyword}%");

        $roles = $roles->paginate(10);

        return view('admin.user.role.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $permissions = Permission::all();
        return view('admin.user.role.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $inputs = $request->all();
        $role = Role::create($inputs);
        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);

        Log::info("نقش با عنوان {$role->title} توسط {$request->user()->full_name} ایجاد شد.");

        return to_route('admin.user.roles.index')->with('toast-success' , 'نقش جدید ایجاد شد');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all();
        return view('admin.user.role.edit' ,compact('role' , 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        DB::transaction(function () use($role , $request) {
            $inputs = $request->all();
            $inputs['permissions'] = $inputs['permissions'] ?? [];
            $role->permissions()->sync($inputs['permissions']);
            $role->update($inputs);
            Log::info("نقش با عنوان {$role->title} توسط {$request->user()->full_name} ویرایش شد.");
        });
        return to_route('admin.user.roles.index')->with('toast-success' , 'تغییرات روی نقش اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        $user = auth()->user()->full_name;

        Log::warning("نقش با عنوان {$role->title} توسط {$user} حذف شد.");

        return back()->with('cute-success', 'نقش حذف گردید.');
    }

}
