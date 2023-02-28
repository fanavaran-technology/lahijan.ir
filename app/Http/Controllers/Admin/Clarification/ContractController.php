<?php

namespace App\Http\Controllers\Admin\Clarification;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clarification\ContractRequest;
use App\Models\Clarification\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ContractController extends Controller
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
        $contracts = Contract::query();
        if ($searchString = request('search'))
            $contracts->where('title', "LIKE", "%{$searchString}%");

        $contracts = $contracts->latest()->paginate(15);
        return view('admin.clarification.contract.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.clarification.contract.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request): RedirectResponse
    {
        $inputs = $request->all();

        $contract = Contract::create($inputs);

        Log::info("قرارداد با عنوان {$contract->title} توسط {$request->user()->full_name} ایجاد شد.");

        return to_route('admin.clarification.contracts.index')->with('toast-success' , 'قرارداد جدید اضافه گردید.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract): View
    {
        return view('admin.clarification.contract.edit' , compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, Contract $contract): RedirectResponse
    {
        $inputs = $request->all();

        $inputs['is_private'] = $inputs['is_private'] ?? 0;

        $contract->update($inputs);

        Log::info("قرارداد با عنوان {$contract->title} توسط {$request->user()->full_name} ویرایش شد.");

        return to_route('admin.clarification.contracts.index')->with('toast-success' , 'قرارداد ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract): RedirectResponse
    {
        $contract->delete();

        $user = auth()->user()->full_name;
        Log::warning("قرارداد با عنوان {$contract->title} توسط {$user} حذف شد.");

        return back()->with('toast-success' , 'قرارداد حذف گردید');
    }
}
