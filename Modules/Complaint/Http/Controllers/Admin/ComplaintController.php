<?php

namespace Modules\Complaint\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Complaint\Entities\Complaint;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */


    public function __construct()
    {
        $this->middleware('can:manage_complaint');
    }

    public function index()
    {
        $complaints = Complaint::query();

        $complaints = $complaints->latest()->paginate(10);

        return view('complaint::admin.complaint.index', compact('complaints'));
    }

    public function fetch()
    {
        $complaints = Complaint::query();

        switch ($filter = request('filter')) {
            case 'not-referenced-complaints':
                $complaints->whereNull('reference_id');
                break;
            case 'referenced-complaints':
                $complaints->whereNotNull('reference_id');
                break;
            case 'waiting-answer':
                $complaints->whereNotNull("reference_id")->where('is_invalid', 0)->whereNull('answer');
                break;
            case 'invalid-complaints':
                $complaints->where('is_invalid', 1);
                break;
            case 'answered-complaints':
                $complaints->where('is_answered', 1);
                break;
        }

        if ($search = request('search')) {
            $complaints->where("subject", 'LIKE', "%{$search}%")->orWhere('first_name', "LIKE", "%{$search}%")->orWhere("last_name", "LIKE", "%{$search}%");
        }

        $complaints = $complaints->latest()->paginate(10);

        return response()->json($complaints);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('complaint::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Complaint $complaint)
    {
        dd($complaint);
        // return view('complaint::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Complaint $complaint): View
    {
        return view('complaint::admin.complaint.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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