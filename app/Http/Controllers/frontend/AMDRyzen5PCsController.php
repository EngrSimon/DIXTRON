<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AMDRyzen5PCsController extends Controller
{
    public function index()
    {
        return view('frontend.AMDRyzen5PCs');
    }
}
