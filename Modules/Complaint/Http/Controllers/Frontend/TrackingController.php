<?php

namespace Modules\Complaint\Http\Controllers\Frontend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Complaint\Entities\Complaint;
use Modules\Complaint\Http\Requests\Frontend\TrackingRequest;

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
        return view('complaint::frontend.tracking.index', compact('complaint'));
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
        return to_route('complaints.tracking.index');
    }   
}
