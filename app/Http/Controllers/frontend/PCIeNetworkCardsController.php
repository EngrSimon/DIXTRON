<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PCIeNetworkCardsController extends Controller
{
    public function index()
    {
        return view('frontend.PCIeNetworkCards');
    }
}
