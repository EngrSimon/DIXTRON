<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NvidiaRTX4000seriesPcsController extends Controller
{
    public function index()
    {
        return view('frontend.NvidiaRTX4000seriesPcs');
    }
}
