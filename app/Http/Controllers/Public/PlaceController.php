<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Content\Place;
use Illuminate\Http\Request;

class placeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::latest()->paginate(12);
        return view('app.content.places.index' ,  compact('places'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $places)
    {
        return view('app.content.places.show' , compact('places'));
    }
}
