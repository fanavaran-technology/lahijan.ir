<?php

namespace Modules\Complaint\Http\Controllers\Frontend;

use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
<<<<<<< HEAD
use Modules\Complaint\Entities\Complaint;
=======
>>>>>>> bad449666a8428bf354abe1194dfbc03373f29be
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
//         dd('hi');
        return view('complaint::create');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('complaint::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        $inputs = $request->all();

        $randomNumber = rand(111111111, 999999999);
        while ( Complaint::where('tracking_code', $randomNumber)->exists())
        {
            $randomNumber = rand(111111111, 999999999);
        }
        $inputs['tracking_code'] = $randomNumber;

        Complaint::create($inputs);


=======
        dd($request->all());
>>>>>>> bad449666a8428bf354abe1194dfbc03373f29be
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
            'file' => 'required|file|mimes:jpg,jpeg,png,gif|max:1024', // محدودیت نوع و اندازه فایل
        ]);

        $uploadedFiles = $request->file('file');

        $imageService->setImageName(Str::random(24));

        $imageService->setExclusiveDirectory("images" . DIRECTORY_SEPARATOR . "complaints" . DIRECTORY_SEPARATOR . "plaintiff");
        $image = $imageService->save($uploadedFiles);

        return response()->json(['path' => $image]);
    }
}