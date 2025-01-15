<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrinterInksAndCartridgesController extends Controller
{
    public function index()
    {
        return view('frontend.PrinterInksAndCartridges');
    }
}
