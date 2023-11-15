<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfirmableMobileController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('auth.confirm-mobile');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $redirectURI = session()->get('request-uri');
        
        $validData = $request->validate([
            'mobile' => 'required|numeric|regex:/(09)[0-9]{9}/|digits:11'
        ]);

        auth()->user()->update($validData);

        session()->remove('request-uri');

        return redirect($redirectURI)->with('toast-success', 'شماره تلفن شما ثبت گردید.');
        

    }

}