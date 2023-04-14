<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Mayor;
use Illuminate\Http\Request;

class MayorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
//        $mayors = Mayor::max('birthdate');
//        $maxBirthdate = DB::table('table_name')->max('birthdate');

        $mayors = Mayor::where('status' , 1)->orderBy('birthdate', 'asc')->get();


        return view('app.content.mayor.index' , compact('mayors'));
    }


}
