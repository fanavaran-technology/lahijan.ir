<?php

namespace App\Http\Controllers\FireStation;

use App\Http\Controllers\Controller;
use App\Models\Content\FireSlider;
use App\Models\Content\News;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FireStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $fireSliders = FireSlider::latest()->take(8)->where('status' , 1)->get();
        $fireStations = News::latest()->where('is_fire_station' , 1)->paginate(12);
        return view('app.fire-station.index' , compact('fireStations' , 'fireSliders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news): View
    {
        $latestNewsFireStation = News::latest()->where('is_fire_station' , 1)->take(10)->get()->except($news->id);
        return view('app.fire-station.show' , compact('news' , 'latestNewsFireStation' ));
    }

}
