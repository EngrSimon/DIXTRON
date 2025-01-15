<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HardDrivesInternalHDDsController extends Controller
{
    public function index()
    {
        return view('frontend.HardDrivesInternalHDDs');
    }
}
