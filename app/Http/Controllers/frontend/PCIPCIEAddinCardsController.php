<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PCIPCIEAddinCardsController extends Controller
{
    public function index()
    {
        return view('frontend.PCIPCIEAddinCards');
    }
}
