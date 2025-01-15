<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComputerRepairsAndTroubleshootingController extends Controller
{
    public function index()
    {
        return view('frontend.ComputerRepairsAndTroubleshooting');
    }
}
