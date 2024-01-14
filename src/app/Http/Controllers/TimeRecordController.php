<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\Rest;
use Carbon\Carbon;

class TimeRecordController extends Controller
{
    public function index() {
        $user = Auth::user();
        $message = $user->name . 'さんお疲れ様です!';
        $today = Carbon::now();
        $yesterday = Carbon::yesterday();
        // テスト用
        // $comparison_day = strtotime($today->setDate(2024,1,15)->format('Y-m-d'));
        $comparison_day = strtotime($today->format('Y-m-d'));
        $old_work = Work::where('user_id', $user->id)->whereNull('end_time')->first();
        $leaving_work_count = Work::where('user_id', $user->id)->where('work_date', $today->format('Y-m-d'))->whereNotNull('end_time')->count();
        $work_count = Work::where('user_id', $user->id)->whereNull('end_time')->count();

        if ($work_count > 0) {
            $rest_count = Rest::where('work_id', $old_work->id)->whereNull('end_time')->count();
        }else{
            $rest_count = 0;
        }
        if (isset($old_work)) {
            $old_workday = strtotime($old_work->work_date);
            $old_rest = Rest::where('work_id', $old_work->id)->whereNull('end_time')->first();
        }
        if ((isset($old_workday))&&($old_workday < $comparison_day)) {
            $update_work = Work::find($old_work->id);
            $update_work->update(["end_time" => $yesterday->setTime(23,59,59)->format('H:i:s')]);
            $work = work::create([
                'user_id' => $user->id,
                'work_date' => $today,
                'start_time' => $today->setTime(0,0,0)->format('H:i:s'),
            ]);
        }
        if (isset($old_rest)&&($old_workday < $comparison_day)) {
            $update_rest = Rest::find($old_rest->id);
            $update_rest->update(["end_time" => $yesterday->setTime(23,59,59)->format('H:i:s')]);
            $work = Work::where('user_id', $user->id)->where('work_date', $today->format('Y-m-d'))->first();
            $rest = Rest::create([
                'work_id' => $work->id,
                'start_time' => $today->setTime(0,0,0)->format('H:i:s'),
        ]);
        }

        return view('record', compact('message', 'work_count', 'rest_count', 'leaving_work_count'));
    }

    public function store(Request $request) {
        if ($request->has('work__start')) {
            $this->workStart();
        } elseif ($request->has('rest__start')) {
            $this->restStart();
        };

        return back();
    }

    public function update(Request $request) {
        if ($request->has('work__end')) {
            $this->workEnd();
        } elseif($request->has('rest__end')) {
            $this->restEnd();
        };

        return back();
    }

    public function workStart() {
        $user_id = Auth::id();
        $work_start = Carbon::now();
        $work = work::create([
            'user_id' => $user_id,
            'work_date' => $work_start->format('Y-m-d'),
            'start_time' => $work_start->format('H:i:s'),
        ]);
    }

    public function restStart() {
        $user_id = Auth::id();
        $rest_start = Carbon::now();
        $work = Work::where('user_id', $user_id)->where('work_date', $rest_start->format('Y-m-d'))->first();
        $rest = Rest::create([
            'work_id' => $work->id,
            'start_time' => $rest_start->format('H:i:s'),
        ]);
    }

    public function workEnd() {
        $user_id = Auth::id();
        $work_end = Carbon::now();
        $old_work = Work::where('user_id', $user_id)->where('work_date', $work_end->format('Y-m-d'))->first();
        $update_work = Work::find($old_work->id);
        $update_work->update(["end_time" => $work_end->format('H:i:s')]);
    }

    public function restEnd() {
        $user_id = Auth::id();
        $rest_end = Carbon::now();
        $work = Work::where('user_id', $user_id)->where('work_date', $rest_end->format('Y-m-d'))->first();
        $old_rest = Rest::where('work_id', $work->id)->whereNull('end_time')->first();
        $update_rest = Rest::find($old_rest->id);
        $update_rest->update(["end_time" => $rest_end->format('H:i:s')]);
    }
}
