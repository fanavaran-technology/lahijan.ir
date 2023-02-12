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
use Database\Seeders\PermissionSeeder;


class UserController extends Controller
{

    public function __construct() 
    {   
        $this->middleware('password.confirm')->except('index' , 'create' , 'store');
        $this->middleware('users.prohibition')->except('index', 'create', 'store');
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
    
        $users = User::query();

        if ($searchString = request('search'))
            $users->where('full_name', "LIKE" , "%{$searchString}%");

        if (request('staff')) 
            $users->where('is_staff', 1);

        if (request('block')) 
            $users->where('is_block', 1);

        $users = $users->whereIsAdmin(0)->whereNot('id', auth()->user()->id)->latest()->paginate(10);

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
    
    if ($user->news->isNotEmpty() && $user->publicCalls->isNotEmpty()) {
        return to_route('admin.content.menus.index')->with('toast-error' , 'حذف این کاربر امکانپذیر نیست.');
    }

    $user->delete();
    return to_route('admin.user.users.index')->with('toast-success' , "کاربر {$user->full_name} حذف گردید.");
}

    
}
