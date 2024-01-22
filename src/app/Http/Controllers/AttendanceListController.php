<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Models\Work;
use App\Models\Rest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceListController extends Controller
{
    public function index() {
        $search_date = Carbon::today();
        $works = Work::where('work_date', '=', $search_date)->simplePaginate(5);

        return view('attendance', compact('works', 'search_date'));
    }

    public function search(Request $request) {
        $append_param=[];
        $search_date = new carbon($request->search_day);
        if($request->add_day == "add_day"){
            $search_date->addDay();
            $append_param['search_day'] = $search_date;
        } else if($request->sub_day == "sub_day") {
            $search_date->subDay();
            $append_param['search_day'] = $search_date;
        }
        $works = Work::where('work_date', '=', $search_date)->paginate(5);
        $works->appends($append_param);

        return view('attendance', compact('works', 'search_date'));
    }
}
