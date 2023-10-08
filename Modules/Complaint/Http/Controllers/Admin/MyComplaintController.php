<?php

namespace Modules\Complaint\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Routing\Controller;
use Modules\Complaint\Entities\Complaint;

class MyComplaintController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:complaint_handler');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('complaint::admin.my-complaint.index');
    }

    public function fetch()
    {
        $complaints = auth()->user()->complaints();

        switch (request('filter')) {
            case 'unanswered-complaints':
                $complaints->whereNull('answer');
                break;
            case 'answered-complaints':
                $complaints->whereNotNull('answer');
                break;
            case 'invalid-complaints':
                $complaints->where('is_invalid', 1);
                break;
        }

        if ($search = request('search')) {
            $complaints->where("subject", 'LIKE', "%{$search}%");
        }

        $complaints = $complaints->latest()->paginate(10);

        return response()->json($complaints);
    }

    public function show(Complaint $complaint)
    {
        return view('complaint::admin.my-complaint.show', compact('complaint'));
    }

    public function answer(Request $request, Complaint $complaint) 
    {
        $validData = $request->validate([
            'answer' => 'required|min:5'
        ]);

        $complaint->forceFill([
            'answer' => $validData['answer'],
            'is_invalid' => 0,
            'is_answered' => 1,
            'answered_at' => now()
        ]);

        $complaint->save();

        return back()->with('toast-success', 'پاسخ شما با موفقیت ثبت گردید.');
    }

}