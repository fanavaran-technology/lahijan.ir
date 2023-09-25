<?php

namespace Modules\Complaint\Http\Controllers\Frontend;

use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
<<<<<<< HEAD

use Modules\Complaint\Entities\Complaint;

=======
use Modules\Complaint\Entities\Complaint;
>>>>>>> 422deeb8fa909b6575fa4b9e214be3b497fdca3c
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('complaint::create');
    }
=======
>>>>>>> 422deeb8fa909b6575fa4b9e214be3b497fdca3c

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

=======
>>>>>>> 422deeb8fa909b6575fa4b9e214be3b497fdca3c
        $inputs = $request->all();

        $randomNumber = rand(111111111, 999999999);
        while ( Complaint::where('tracking_code', $randomNumber)->exists())
        {
            $randomNumber = rand(111111111, 999999999);
        }
        $inputs['tracking_code'] = $randomNumber;

        Complaint::create($inputs);
<<<<<<< HEAD


=======
>>>>>>> 422deeb8fa909b6575fa4b9e214be3b497fdca3c
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
