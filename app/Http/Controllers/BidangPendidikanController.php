<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidangPendidikanController extends Controller
{
    public function index()
{
    return view('bidang_pendidikan.index');
}
}
