<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AMDRyzen9PCsController extends Controller
{
    public function index()
    {
        return view('frontend.AMDRyzen9PCs');
    }
}
