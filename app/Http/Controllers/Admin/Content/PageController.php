<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = 1;
        $pages = Page::create($inputs);
        return to_route('admin.content.pages.index')->with('toast-success' , 'صفحه جدید اضافه شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.content.page.edit' , compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $inputs = $request->all();

        $inputs['is_draft'] = $inputs['is_draft'] ?? 0; 
        $inputs['is_quick_access'] = $inputs['is_quick_access'] ?? 0; 

        $inputs['user_id'] = 1;
        $page->update($inputs);
        return to_route('admin.content.pages.index')->with('toast-success' , 'صفحه ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $result = $page->delete();
        return back()->with('toast-success', 'صفحه حذف گردید.');
    }

    public function is_draft(Page $page)
    {
        $page->is_draft = $page->is_draft == 0 ? 1 : 0;
        $result = $page->save();
        if ($result) {
            if ($page->is_draft == 0) {
                return response()->json(['is_draft' => true, 'checked' => false]);
            } else {
                return response()->json(['is_draft' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['is_draft' => false]);
        }
    }


    public function isQuickAccess(Page $page)
    {
        $page->is_quick_access = $page->is_quick_access == 0 ? 1 : 0;
        $result = $page->save();
        if ($result) {
            if ($page->is_quick_access == 0) {
                return response()->json(['is_quick_access' => true, 'checked' => false]);
            } else {
                return response()->json(['is_quick_access' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['is_quick_access' => false]);
        }
    }
}