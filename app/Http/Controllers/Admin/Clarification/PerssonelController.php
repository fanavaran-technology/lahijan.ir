<?php

namespace App\Http\Controllers\Admin\Clarification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Clarification\PerssonelRequest;
use App\Models\Clarification\Perssonel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PerssonelController extends Controller
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
        $perssonels = Perssonel::query();

        if ($searchString = request('search'))
            $perssonels->where('first_name', "LIKE", "%{$searchString}%")->orWhere('last_name', "LIKE", "%{$searchString}%");

        if (request('is_disable'))
            $perssonels->where('is_disable', 1);

        $perssonels = $perssonels->latest()->paginate(15);

        return view('admin.clarification.perssonel.index', compact('perssonels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.clarification.perssonel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerssonelRequest $request): RedirectResponse
    {
        $inputs = $request->all();
        $perssonel = Perssonel::create($inputs);

        Log::info("کارمند با نام {$perssonel->full_name} توسط {$request->user()->full_name} ایجاد شد.");

        return to_route('admin.clarification.perssonels.index')->with('toast-success' , 'کارمند جدید اضافه گردید');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Perssonel $perssonel): View
    {
        return view('admin.clarification.perssonel.edit' , compact('perssonel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerssonelRequest $request, Perssonel $perssonel): RedirectResponse
    {
        $inputs = $request->all();

        $perssonel->update($inputs);

        Log::info("کارمند با نام {$perssonel->full_name} توسط {$request->user()->full_name} ویرایش شد.");

        return to_route('admin.clarification.perssonels.index')->with('toast-success' , 'کارمند ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perssonel $perssonel): RedirectResponse
    {
        $perssonel->salaries()->detach();

        $perssonel->delete();

        $user = auth()->user()->full_name;

        Log::warning("کارمند با نام {$perssonel->full_name} توسط {$user} حذف شد.");

        return back()->with('toast-success' , 'از لیست کارمندان حذف گردید.');
    }

    public function disable(Perssonel $perssonel)
    {
        $perssonel->is_disable = $perssonel->is_disable == 0 ? 1 : 0;
        $result = $perssonel->save();

        if ($result) {
            if ($perssonel->is_disable == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
}
