<?php

namespace App\Http\Controllers\Communication;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunicationRequest;
use App\Models\Communication;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommunicationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $types = Communication::REQUEST_TYPES;
        return view('app.communication.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunicationRequest $request): RedirectResponse
    {
        $inputs = $request->all();

        DB::transaction(function () use($inputs, $request) {
            Communication::create([
                'full_name'=> $inputs['full_name'],
                'subject'=> $inputs['subject'],
                'type'=> $inputs['type'],
                'phone'=> $inputs['phone'],
                'description'=> $inputs['description'],
                'address'=> $inputs['address']
            ]);

            Log::info("{$inputs['full_name']} فرمی ارسال کرد. آی پی : {$request->ip()}");
        });

        $type = Communication::REQUEST_TYPES[(int) $inputs['type']];

        return to_route('communications.create')->with('toast-success' , "با تشکر از مشارکت شما ، {$type} ثبت گردید.");
    }

}
