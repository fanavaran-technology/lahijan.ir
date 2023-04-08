<?php

namespace App\Http\Controllers\Clarification;

use App\Http\Controllers\Controller;
use App\Models\Clarification\Contract;
use App\Models\Clarification\SalarySubject;
use App\Models\Content\News;
use Illuminate\View\View;

class ClarificationController extends Controller
{

    public function index(): View
    {
        return view('app.clarification.index');
    }

    public function salary()
    {
        $salaries = SalarySubject::latest()->paginate(10);
        return view('app.clarification.salary' , compact('salaries'));
    }

    public function showSalary(SalarySubject $salarySubject)
    {
        $perssonelSalaries = $salarySubject->perssonels()->paginate(10);
        return view('app.clarification.show-salary' , compact('salarySubject' , 'perssonelSalaries'));
    }

    public function contract()
    {
        $contracts = Contract::where('is_private' , 0)->latest()->paginate(10);
        return view('app.clarification.contract' , compact('contracts'));
    }


    public function showContract(Contract $contract)
    {
        return view('app.clarification.show-contract' , compact('contract'));
    }

    public function news()
    {
        $allNews = News::where('is_auction_tender' , 1)->latest()->paginate(10);
        return view('app.clarification.auction' , compact('allNews'));
    }


}

