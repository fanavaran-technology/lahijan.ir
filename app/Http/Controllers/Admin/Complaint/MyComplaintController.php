<?php

namespace App\Http\Controllers\Admin\Complaint;

use App\Models\ACL\Permission;
use App\Models\User;
use App\Notifications\Channels\SMSChannel;
use App\Notifications\Complaint\ConfirmReferreComplaint;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Complaint\Complaint;
use App\Rules\Complaint\ComplaintFilesRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Notification;


class MyComplaintController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:complaint_handler')->except('confirm');
        $this->middleware('can:manage_complaint')->only('confirm');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   
        $user = auth()->user();

        foreach($user->notifications as $notification) {
            $notification->update(['read_at' => now()]);
        }

        $complaintsCount = [
            'all' => $user->complaints()->count(),
            'unanswereds' => $user->complaints()->whereNull('answer')->count(),
            'answereds' => $user->complaints()->whereNotNull('answer')->count(),
            'invalids' => $user->complaints()->whereHas('userFails', function($userFail) use($user) {
                return $userFail->where('user_id', $user->id);
            })->count(),
        ];
        return view('admin.complaint.my-complaint.index', ['complaintsCount' => $complaintsCount]);
    }

    public function fetch()
    {
        $complaints = auth()->user()->complaints();

        switch (request('filter')) {
            case 'unanswered-complaints':
                $complaints->whereNull('answer');
                break;
            case 'answered-complaints':
                $complaints->whereNotNull('answer');
                break;
            case 'invalid-complaints':
                $complaints->whereHas('userFails', function($userFail) {
                    return $userFail->where('user_id', auth()->user()->id);
                });
                break;
        }

        if ($search = request('search')) {
            $complaints->where("subject", 'LIKE', "%{$search}%");
        }

        $complaints = $complaints->latest()->paginate(10);

        return response()->json($complaints);
    }

    public function show(Complaint $complaint)
    {
        return view('admin.complaint.my-complaint.show', compact('complaint'));
    }

    public function answer(Request $request, Complaint $complaint) 
    {
        $validData = $request->validate([
            'answer' => 'required|min:5',
            'files'         => [new ComplaintFilesRule],
        ]);

        
        DB::transaction(function () use($complaint, $validData, $request) {
            $complaint->forceFill([
                'answer' => $validData['answer'],
                'is_invalid' => 0,
                'is_answered' => 1,
                'answered_at' => now(),
            ]);
    
            if ($request->filled('files')) {
                $complaint->files()->create([
                    'files' => explode(',', $validData['files']),
                    'user_id' => auth()->user()->id
                ]);
            }

            $userName = auth()->user()->full_name;

            complaintConfig('confirm_referrer') ? $this->confirmReferrerNotify($complaint) : $this->confirm($complaint);

            Log::info("{$userName} پاسخی برای شکایت {$complaint->subject} ثبت کرد.");
        });
        
        $complaint->save();

        // return back()->with('toast-success', 'پاسخ شما با موفقیت ثبت گردید.');
    }

    public function confirm(Complaint $complaint) 
    {
        $complaint->forceFill([
            'is_confirm' => 1
        ]);

        $complaint->save();

        $smsCahnnel = new SMSChannel();

        $message = "کاربر گرامی پاسخی برای شکایت شما ثبت گردید شما می توانید با کد پیگیری {$complaint->tracking_code} شکایت خود را پیگیری کنید - شهرداری لاهیجان";

        $details = [
            'message' => $message,
            'mobile' => $complaint->phone_number
        ];

        $smsCahnnel->sendWithoutUser($details);

        return back()->with('toast-success', 'پاسخ متصدی تایید شد.');
    }

    private function confirmReferrerNotify(Complaint $complaint) {
        
        $department = $complaint->department->title;

        $userPermission = Permission::where("key", "manage_complaint")->first()->users()->whereNotNull('mobile')->get();

        $userIds = $userPermission->pluck('id')->toArray();

        $expertUsers = User::whereIn('id', $userIds)->get();

        $details = [
            'message' => "متصدی {$department} پاسخی ثبت کرد ، و در انتظار تایید شماست.",
            'sms_message' => "متصدی {$department} پاسخی ثبت کرد و در انتظار تایید شماست - شهرداری لاهیجان",
        ];

        Notification::send($expertUsers, new ConfirmReferreComplaint($details));
    }

}