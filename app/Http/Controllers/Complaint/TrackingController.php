<?php

namespace App\Http\Controllers\Complaint;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use App\Models\Complaint\Complaint;
use App\Http\Requests\Complaint\TrackingRequest;
use Illuminate\Support\Facades\Log;


class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $complaint = [];
        if (session()->has('complaint')) {
            $complaintId =  session()->get('complaint');
            $complaint = Complaint::findOrFail($complaintId); 
        }
        return view('app.complaint.tracking.index', compact('complaint'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function proccess(TrackingRequest $request): RedirectResponse
    {
        $trackingCode = $request->input('tracking_code');
        $complaint = Complaint::where('tracking_code', $trackingCode)->first();
        
        session()->flash('complaint', $complaint->id);

        Log::info("کاربر با آی پی {$request->ip()} شکایت {$complaint->subject} را مشاهده (پیگیری) کرد");

        return to_route('complaints.tracking.index');
    }   
}
