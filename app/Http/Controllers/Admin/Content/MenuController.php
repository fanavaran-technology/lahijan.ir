<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_menus');
        $this->middleware('can:edit_menu')->only('edit', 'update' , 'status');
        $this->middleware('can:create_menu')->only('store', 'create');
        $this->middleware('can:delete_menu')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $menus = Menu::query();

        if ($searchString = request('search'))
            $menus->where('title', "LIKE" , "%{$searchString}%");

        if (request('status'))
            $menus->where('status', 1);

        $menus = $menus->latest()->paginate(15);
        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $parentMenus = Menu::whereNull('parent_id')->get();
        return view('admin.content.menu.create' , compact('parentMenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request): RedirectResponse
    {
        $inputs = $request->all();

        $menu = Menu::create($inputs);

        Log::info("منو با عنوان {$menu->title} توسط {$request->user()->full_name} ایجاد شد.");

        return to_route('admin.content.menus.index')->with('toast-success', 'منوی چدید اضافه شد.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu): View
    {
        $parentMenus = Menu::whereNull('parent_id')->get()->except($menu->id);
        return view('admin.content.menu.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        DB::transaction(function () use ($request, $menu) {

            $inputs = $request->all();

            $inputs['status'] = $inputs['status'] ?? 0;

            $menu->update($inputs);
            
            Log::info("منو با عنوان {$menu->title} توسط {$request->user()->full_name} ویرایش شد.");
        });

        return to_route('admin.content.menus.index')->with('toast-success' , 'تغییرات روی منو اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu) : RedirectResponse
    {
        if ($menu->childrens->isNotEmpty())
            return to_route('admin.content.menus.index')->with('toast-error' , 'این منو شامل زیر منو می باشد.');


        $menu->delete();
        
        $user = auth()->user()->full_name;
        
        Log::warning("منو با عنوان {$menu->title} توسط {$user} حذف شد.");

        return to_route('admin.content.menus.index')->with('toast-success' , 'منو حذف گردید.');

    }

    public function status(Menu $menu)
    {
        $menu->status = $menu->status == 0 ? 1 : 0;
        $result = $menu->save();

        if ($result) {
            if ($menu->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


}
