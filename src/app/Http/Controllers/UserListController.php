<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\User;
use Carbon\Carbon;

class UserListController extends Controller
{
    public function index() {
        $users = User::select('id', 'name')->groupBy('id')->orderBy('id', 'asc')->paginate(5);
        return view('userlist', compact('users'));
    }

    public function show(Request $request) {
        $user_id = $request->id;
        $search_month = Carbon::now();
        $users = User::where('id', $request->id)->get();
        $works = Work::where('user_id', $request->id)->orderBy('work_date', 'asc')->whereYear('work_date', $search_month->year)->whereMonth('work_date', $search_month->month)->get();
        return view('userlistworkshow', compact('works', 'users', 'search_month', 'user_id'));
    }

    public function search(Request $request) {
        $user_id = $request->user_id;
        $search_month = new carbon($request->search_month);
        $users = User::where('id', $user_id)->get();
        if($request->next_month == "next_month"){
            $search_month = $search_month->addMonthNoOverflow();
            $append_param['search_month'] = $search_month;
        } else if($request->last_month == "last_month") {
            $search_month = $search_month->subMonthNoOverflow();
            $append_param['search_month'] = $search_month;
        }
        $works = Work::where('user_id', $user_id)->orderBy('work_date', 'asc')->whereYear('work_date', $search_month->year)->whereMonth('work_date', $search_month->month)->Paginate(10);

        return view('userlistworkshow', compact('search_month', 'works', 'users', 'user_id'));
    }
}
