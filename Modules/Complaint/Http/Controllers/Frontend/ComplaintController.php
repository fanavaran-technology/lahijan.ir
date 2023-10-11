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
            'message' => " شکایت با عنوان : {$complaintLatest} ثبت شده است ",
        ];

        $newComplaint = Complaint::latest()->first();
        $newComplaint->notify(new NewComplaint($details));

        return response()->json(['success' => true, 'title' => 'شکایت شما با موفقیت ثبت گردید', 'message' => "شما میتوانید با کد پیگیری {$inputs['tracking_code']} از وضعیت شکایت خود مطلع شوید."]);

    }


    public function upload(Request $request, ImageService $imageService)
    {
        $request->validate([
            'file' => "required|file|mimes:" . str_replace(".", "", complaintConfig('allowed-extensions')) . "|max:1024",
        ]);

        $uploadedFile = $request->file('file');

        $fileName = $uploadedFile->getClientOriginalName();

        if (isImageFile($fileName)) {
            $imageService->setImageName(Str::random(24));

            $imageService->setExclusiveDirectory("images" . DIRECTORY_SEPARATOR . "complaints" . DIRECTORY_SEPARATOR . "plaintiff");
            $file = $imageService->save($uploadedFile);
        }
        else {
            $ext = $uploadedFile->extension();
            $file = "docs/" . $uploadedFile->storeAs('/complaints/plaintiff', Str::random(24) . '.' . $ext, ['disk' => 'docs']);
        }


        return response()->json(['path' => $file]);
    }
}