<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\ACL\Role;
use Illuminate\Http\Request;
use App\Models\ACL\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;

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
    public function index()
    {
        $roles = Role::all();
        return view('admin.user.role.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $role = Role::create($inputs);
        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return to_route('admin.user.roles.index')->with('toast-success' , 'نقش جدید ایجاد شد');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.user.role.edit' ,compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        return to_route('admin.user.roles.index')->with('toast-success' , 'تغییرات روی نقش اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $result = $role->delete();
        return back()->with('cute-success', 'نقش حذف گردید.');
    }

    public function permissionForm(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.user.role.permission-form' ,compact('role' , 'permissions'));
    }

    public function permissionUpdate(RoleRequest $request , Role $role)
    {
        $inputs = $request->all();
        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return to_route('admin.user.roles.index')->with('toast-success' , 'دسترسی ویرایش شد');
    }
}
