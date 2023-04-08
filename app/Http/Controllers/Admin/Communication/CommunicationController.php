<?php

namespace App\Http\Controllers\Admin\Communication;

use App\Http\Controllers\Controller;
use App\Models\Communication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $allCommunications = Communication::query();

        if ($searchString = request('search'))
            $allCommunications->where('subject', "LIKE" , "%{$searchString}%");

        if ($type = request('type')) {
            $findIndex = array_search($type, Communication::REQUEST_TYPES);
            $allCommunications->where('type', $findIndex);
        }

        $allCommunications = $allCommunications->latest()->paginate(15);

        return view('admin.communication.index' ,  compact('allCommunications'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Communication $communication): View
    {
        return view('admin.communication.edit' , compact('communication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Communication $communication): RedirectResponse
    {
        $validData = $request->validate([
            'response'=> 'required|min:2|max:50000'
        ]);

        $communication->update([
            'response'=> $validData['response']
        ]);

        return to_route('admin.communications.index')->with('toast-success', 'پاسخ و پیگیری پیام صورت گرفت.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Communication $communication): RedirectResponse
    {
        $communication->delete();

        return back()->with('toast-success' , 'پیام حذف گردید.');
    }
}
