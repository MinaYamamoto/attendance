<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class Work extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'work_date', 'start_time', 'end_time'];

    public function getWorkTime() {
        $rests = DB::table('rests')->select(['id','work_id', 'start_time', 'end_time'])->orderBy('work_id', 'asc')->get();

        $work_time = 0;
        $rest_total = 0;

        foreach($rests as $value) {
            if($value->work_id === $this->id)  {
                $rest_start_time = new Carbon($value->start_time);
                $rest_end_time = new Carbon($value->end_time);
                $rest_seconds = $rest_start_time->diffInSeconds($rest_end_time);
                $rest_total += $rest_seconds;
            }
        }

        if(isset($this->end_time)) {
            $work_start_time = new Carbon($this->start_time);
            $work_end_time = new Carbon($this->end_time);
            $work_seconds = $work_start_time->diffInSeconds($work_end_time);
            $work_seconds -= $rest_total;
            $work_hour = floor($work_seconds / 3600);
            $work_min = floor(($work_seconds % 3600) / 60);
            $work_sec = $work_seconds % 60;
            $work_time = sprintf('%02d', $work_hour) . ":" . sprintf('%02d',$work_min) . ":" . sprintf('%02d',$work_sec);
        } else {
            $work_time = "00:00:00";

        }

        return ($work_time);
    }

    public function getRestTime() {
        $rests = DB::table('rests')->select(['id','work_id', 'start_time', 'end_time'])->orderBy('work_id', 'asc')->get();

        $rest_total = 0;

        foreach($rests as $value) {
            if($value->work_id === $this->id) {
                $rest_start_time = new Carbon($value->start_time);
                $rest_end_time = new Carbon($value->end_time);
                $rest_seconds = $rest_start_time->diffInSeconds($rest_end_time);
                $rest_total += $rest_seconds;
            }
            $rest_hour = floor($rest_total / 3600);
            $rest_min = floor(($rest_total % 3600) / 60);
            $rest_sec = $rest_total % 60;
            $rest_time = sprintf('%02d', $rest_hour) . ":" . sprintf('%02d',$rest_min) . ":" . sprintf('%02d',$rest_sec);
        }

        return($rest_time);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
