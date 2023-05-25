<?php

namespace App\Http\Controllers\FireStation;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use App\Models\Content\Page;
use App\Models\Content\Place;
use App\Models\Content\PublicCall;
use Illuminate\Http\Request;

class FireSearchController extends Controller
{
    const SEARCH_TYPES = [
        'news'          =>  News::class,
    ];

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        if (empty($keyword = request('search'))) {
            return back();
        }

        $model = self::SEARCH_TYPES[request('type')] ?? self::SEARCH_TYPES['news'];

        $results = $model::where($model::SEARCH_KEY , 'LIKE' , "%{$keyword}%")->latest()->where('is_fire_station' , 1)->paginate(12);

        return view('app.fire-station.search' , compact('results'));
    }
}
