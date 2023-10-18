<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Complaint\Complaint;
use Illuminate\Support\Str;
use App\Http\Requests\Complaint\ComplaintRequest;
use App\Notifications\NewComplaint;
use Illuminate\Support\Facades\Log;

class ComplaintController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('app.complaint.create');
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

        // send notification
        $details = [
            'message' => " شکایت با عنوان : {$complaint->subject} ثبت شده است ",
        ];

        $complaint->notify(new NewComplaint($details));

        Log::info("کاربر با آی پی {$request->ip()} شکایتی با عنوان {$complaint->subject} ثبت کرد");

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

        Log::info("کاربر با آی پی {$request->ip()} فایلی را برای یک شکایت آپلود کرد.");

        return response()->json(['path' => $file]);
    }
}
