<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_pages');
        $this->middleware('can:edit_page')->only('edit', 'update' , 'is_draft' ,'isQuickAccess');
        $this->middleware('can:create_page')->only('store', 'create');
        $this->middleware('can:delete_page')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $pages = Page::query();

        if ($searchString = request('search'))
            $pages->where('title', "LIKE" , "%{$searchString}%");

        if (request('status')) 
            $pages->where('is_draft', 1);

        if (request('quick-access')) 
            $pages->where('is_quick_access', 1);

        
        $pages = $pages->latest()->paginate(10);
        return view('admin.content.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.content.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request): RedirectResponse
    {
        $inputs = $request->all();
                
        $page = auth()->user()->pages()->create($inputs);

        $user = auth()->user()->full_name;

        Log::info("صفحه با عنوان {$page->title} توسط {$user} ایجاد شد.");

        return to_route('admin.content.pages.index')->with('toast-success' , 'صفحه جدید اضافه شد');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page): View
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
    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $inputs = $request->all();

        $inputs['is_draft'] = $inputs['is_draft'] ?? 0; 
        $inputs['is_quick_access'] = $inputs['is_quick_access'] ?? 0; 

        $page->update($inputs);
        
        Log::info("صفحه با عنوان {$page->title} توسط {$request->user()->full_name} ویرایش شد.");
        
        return to_route('admin.content.pages.index')->with('toast-success' , 'صفحه ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        Log::warning("منو با عنوان {$page->title} توسط {auth()->user()->full_name} حذف شد.");

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
