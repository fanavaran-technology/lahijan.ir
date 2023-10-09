<?php

namespace Modules\Complaint\Http\Controllers\Frontend;

use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Notification;
use Modules\Complaint\Entities\Complaint;
use Illuminate\Support\Str;
use Modules\Complaint\Entities\ComplaintFile;
use Modules\Complaint\Entities\Departement;
use Modules\Complaint\Http\Requests\Frontend\ComplaintRequest;
use Illuminate\Support\Facades\DB;
use Modules\Complaint\Notifications\NewComplaint;
use Modules\Complaint\Notifications\NewDepartment;

class ComplaintController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('complaint::frontend.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ComplaintRequest $request)
    {
        $inputs = $request->all();
        $inputs['tracking_code'] = Complaint::generateTrackingCode();


            $complaint = Complaint::create($inputs);

            if ($request->filled('files')) {
                $complaint->files()->create([
                    'files' => explode(',', $inputs['files']),
                ]);
            }

        $complaintLatest = Complaint::latest()->pluck('subject')->first();

        $details = [
            'message' => " شکایت با عنوان : {$complaintLatest} ثبت شده است " ,
        ];

        $newComplaint = Complaint::latest()->first();
        $newComplaint->notify(new NewComplaint($details));

        return response()->json(['success' => true, 'title' => 'شکایت شما با موفقیت ثبت گردید', 'message' => "شما میتوانید با کد پیگیری {$inputs['tracking_code']} از وضعیت شکایت خود مطلع شوید."]);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('complaint::show');
    }


    public function upload(Request $request, ImageService $imageService)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        $uploadedFiles = $request->file('file');

        $imageService->setImageName(Str::random(24));

        $imageService->setExclusiveDirectory("images" . DIRECTORY_SEPARATOR . "complaints" . DIRECTORY_SEPARATOR . "plaintiff");
        $image = $imageService->save($uploadedFiles);

        return response()->json(['path' => $image]);
    }
}
