<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Models\ACL\Role;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ACL\Permission;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\UserRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $users = User::whereIsAdmin(0)->latest()->paginate(15);
        return view('admin.user.users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user): View
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.users.create' , compact('roles' , 'user' , 'permissions') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request , User $user, ImageService $imageService) :RedirectResponse
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();

            // save profile photo
            if ($request->hasFile('profile_photo')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "user" . DIRECTORY_SEPARATOR . "avatars");
                $image = $imageService->save($request->profile_photo);
                $inputs['profile_photo'] = $image;
            }
           $user = User::create($inputs);

           if ($user->is_staff) {
            if ($request->has('roles'))
            $user->roles()->sync($inputs['roles']);

            if ($request->has('permissions'))
            $user->permissions()->sync($inputs['permissions']);
           }
        });

        return to_route('admin.user.users.index')->with('toast-success' , 'کاربر جدید ایجاد شد.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user): View
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.users.edit', compact('user' , 'roles' , 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        DB::transaction(function () use ($request , $user) {
            $inputs = $request->all();

            [$inputs['is_staff'], $inputs['is_block']] = [$inputs['is_staff'] ?? 0, $inputs['is_block'] ?? 0];
            $user->update($inputs);

            if ($user->is_staff) {
                $request->has('roles') ?
                $user->roles()->sync($inputs['roles']) :
                $user->roles()->sync([]);

                $request->has('permissions') ?
                $user->permissions()->sync($inputs['permissions']) :
                $user->permissions()->sync([]);
               }
        });

        return to_route('admin.user.users.index')->with('toast-success' , 'تغییرات روی کاربر اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): RedirectResponse
    {
        
    }

    // change password
    public function changePassword(Request $request , User $user): RedirectResponse
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password'  =>   $validated['password']
        ]);
        
        return to_route('admin.user.users.index')->with('toast-success' , 'کلمه عبور تغییر یافت.'); 
    }

    public function roles(User $user)
    {
        $roles = Role::all();
        return view('admin.user.users.roles', compact('user' , 'roles' ));
    }

    public function roleStore(Request $request , User $user)
    {
        $validated = $request->validate([
            'roles' => 'exists:roles,id|array',
        ]);
        $user->roles()->sync($request->roles);
        return to_route('admin.user.users.index')->with('toast-success' , 'نقش اعمال گردید');
    }

    public function permissions(User $user)
    {
        $permissions = Permission::all();
        return view('admin.user.users.permissions', compact('user'  , 'permissions'));
    }

    public function permissionStore(Request $request , User $user)
    {
        $validated = $request->validate([
            'permissions' => 'exists:permissions,id|array'
        ]);
        $user->permissions()->sync($request->permissions);
        return to_route('admin.user.users.index')->with('toast-success' , 'دسترسی اعمال گردید.');
    }

}
