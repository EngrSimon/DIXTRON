<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AMDRadeonRX7000SeriesPCsController extends Controller
{
    public function index()
    {
        return view('frontend.AMDRadeonRX7000SeriesPCs');
    }
}
