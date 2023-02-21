<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use App\Models\Content\Page;
use App\Models\Content\PublicCall;
use App\Models\Content\Place;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{

    const SEARCH_TYPES = [
        'news'          =>  News::class,
        'public_calls'  =>  PublicCall::class,
        'places'        =>  Place::class,
        'pages'          =>  Page::class
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

        $results = $model::where($model::SEARCH_KEY , 'LIKE' , "%{$keyword}%")->latest()->paginate(12);

        return view('app.content.search' , compact('results'));
    }
}
