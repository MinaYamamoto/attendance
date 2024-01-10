<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkTimeController extends Controller
{
    public function index() {
        return view('record');
    }
}
