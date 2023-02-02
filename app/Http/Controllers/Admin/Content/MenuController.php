<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $menus = Menu::latest()->paginate(15);
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

        Menu::create($inputs);

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
        return to_route('admin.content.menus.index')->with('toast-success' , 'منو حذف گردید.');

    }       
}
