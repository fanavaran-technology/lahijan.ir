<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Morilog\Jalali\Jalalian;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $allNews = News::query();

        if ($dateFilter = $this->dateFilter()) {
            $allNews->where('created_at' , '>=' , $dateFilter['start_date'])->where('created_at' , '<=' , $dateFilter['end_date']);
        }

        if (request("gallery"))
            $allNews->has('gallerizable');

        if (request("video"))
            $allNews->has('video');

        if (request('auction_tender')) 
            $allNews->where('is_auction_tender' , 1);

        $allNews = $allNews->orderBy('is_pined' , 'DESC')->latest()->paginate(12);
        return view('app.content.news.index' ,  compact('allNews'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news): View
    {
        $latestNews = News::latest()->take(10)->get()->except($news->id);
        return view('app.content.news.show' , compact('news' , 'latestNews'));
    }

    private function dateFilter() 
    {
        if ($startDate = request('start_date') || $endDate = request('end_date')) {
            $dateRegex = "/^[0-9]{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/";
            $startDate = request('start_date') ?? jalaliDate(date_create("19-12-2001"));
            $endDate = request('end_date') ?? jalaliDate(now());
            if (preg_match($dateRegex , $startDate) && preg_match($dateRegex , $endDate)) {
                $startDate = Jalalian::fromFormat('Y/m/d' , $startDate)->toCarbon();
                $endDate = Jalalian::fromFormat('Y/m/d' , $endDate)->toCarbon();

                return [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ];
            }
            return false;
        }
    }
}
