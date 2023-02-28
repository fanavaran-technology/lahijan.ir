<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Place;
use Illuminate\Http\Request;
use Illuminate\View\View;

class placeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $places = Place::skip(6)->take(30)->latest()->get();
        return view('app.content.place.index' ,  compact('places'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Place $place): View
    {
        return view('app.content.place.show' , compact('place'));
    }
}
