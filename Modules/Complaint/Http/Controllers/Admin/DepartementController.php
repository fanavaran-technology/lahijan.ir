<?php

namespace Modules\Complaint\Http\Controllers\Admin;

use App\Models\ACL\Permission;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Complaint\Entities\Complaint;
use Modules\Complaint\Entities\Departement;
use Modules\Complaint\Http\Requests\DepartmentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_complaint');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = User::where('is_staff', 1)->get()->except(auth()->user()->id);
        return view('complaint::admin.department.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = User::whereHas('permissions', function ($permission) {
            return $permission->where('key', Departement::HANDLER_PERMISSION);
        })->get();

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

        DB::transaction(function () use ($inputs) {
            $departement = Departement::create($inputs);

            $inputs['users'] = $inputs['users'] ?? [];

            $departement->users()->sync($inputs['users']);

            $userName = auth()->user()->full_name;

            Log::info("{$userName} دپارتمانی با عنوان {$departement->title} ایجاد کرد");
        });

        return to_route('admin.departements.index')->with('toast-success', 'دپارتمان جدید ایجاد شد.');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Departement $departement): View
    {
        $users = User::whereHas('permissions', function ($permission) {
            return $permission->where('key', Departement::HANDLER_PERMISSION);
        })->get();

        return view('complaint::admin.department.edit', compact('departement', 'users'));
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

        foreach ($inputs['users'] as $userId) {
            $user = User::findOrFail($userId);
            $user->permissions()->sync(Permission::getHandlerPermissionId());
        }

        $departement->users()->sync($inputs['users']);

        $userName = auth()->user()->full_name;

        Log::info("{$userName} دپارتمانی با عنوان {$departement->title} را ویرایش کرد");

        return to_route('admin.departements.index')->with('toast-success', 'دپارتمان ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Departement $departement): RedirectResponse
    {
        if ($departement->userFails->isNotEmpty()) {
            return back()->with('toast-error', 'امکان حذف این دپارتمان وجود ندارد.');
        }
        $departement->users()->detach();

        $userName = auth()->user()->full_name;
        Log::info("{$userName} دپارتمانی با عنوان {$departement->title} را حذف کرد");

        $departement->delete();

        return back()->with('toast-success', 'دپارتمان حذف گردید.');
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

    public function fetchUser(Departement $departement)
    {
        $departementUsers = $departement->users;

        return response()->json($departementUsers);
    }

    public function setHandlerPermission(Request $request)
    {
        $validData = $request->validate([
            'user_id.*' => 'exists:users,id'
        ]);


        $handlerPermission = Permission::where('key', Departement::HANDLER_PERMISSION)->firstOrFail();
        dd('hi');

        $validData['user_id'] = $request->get('user_id') ? $request->get('user_id') : [];

        $handlerPermission->users()->sync($validData['user_id']);

        $userName = auth()->user()->full_name;
        Log::info("{$userName} لیست متصدیان را بروز رسانی کرد.");

        return to_route('admin.departements.index')->with('toast-success', 'متصدیان با موفقیت اضافه شدند.');
    }

}