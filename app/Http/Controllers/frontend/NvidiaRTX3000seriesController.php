<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NvidiaRTX3000seriesController extends Controller
{
    public function index()
    {
        return view('frontend.NvidiaRTX3000series');
    }
}
