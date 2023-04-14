<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CouncilMembersRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\CouncilMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CouncilMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage_council');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $councilMembers = CouncilMember::query();

        if ($searchString = request('search'))
            $councilMembers->where('full_name', "LIKE" , "%{$searchString}%");

        $councilMembers = $councilMembers->latest()->paginate(15);
        return view('admin.content.council-member.index' , compact('councilMembers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = CouncilMember::REQUEST_TYPES;
        return view('admin.content.council-member.create' , compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouncilMembersRequest $request , ImageService $imageService)
    {
        DB::transaction(function () use ($request , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'council-members');
                $result = $imageService->save($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.content.council-members.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['image'] = $result;
            }
            $councilMembers = CouncilMember::create($inputs);
            Log::info("عضو جدید شورا با عنوان {$councilMembers->full_name} توسط {$request->user()->full_name} ایجاد شد.");
        });

        return to_route('admin.content.council-members.index')->with('toast-success' , 'شورا شهر جدید اضافه گردید.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CouncilMember $councilMember)
    {
        $types = CouncilMember::REQUEST_TYPES;
        return view('admin.content.council-member.edit' , compact('types' , 'councilMember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouncilMembersRequest $request, CouncilMember $councilMember , ImageService $imageService)
    {
        DB::transaction(function () use($request , $councilMember , $imageService) {
            $inputs = $request->all();

            // save image
            if ($request->hasFile('image')) {
                if (!empty($councilMember->image))
                    $imageService->deleteImage($councilMember->image);

                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "council-members");
                $inputs['image'] = $imageService->save($inputs['image']);
            }

            # update check inputs
            $councilMember->update($inputs);

            Log::info("شورا شهر  با عنوان {$councilMember->full_name} توسط {$request->user()->full_name} ویرایش شد.");
        });

        return to_route('admin.content.council-members.index')->with('toast-success' , 'تغییرات روی شورا شهر اعمال شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CouncilMember $councilMember)
    {
        $councilMember->delete();

        $user = auth()->user()->full_name;

        Log::warning("عضو شورا با عنوان {$councilMember->full_name} توسط {$user} حذف شد.");

        return back()->with('toast-success', 'عضو شورا حذف گردید.');
    }
}
