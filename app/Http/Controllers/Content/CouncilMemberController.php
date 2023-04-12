<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\CouncilMember;
use Illuminate\Http\Request;

class CouncilMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bossCouncil = CouncilMember::where('type' , 0)->get();

        $councilMembers = CouncilMember::where('type' , '!=' , 0)->get();

        return view('app.content.council-member.index' , compact('councilMembers' , 'bossCouncil'));
    }


}
