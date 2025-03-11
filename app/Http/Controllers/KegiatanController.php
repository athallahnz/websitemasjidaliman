<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;


class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all(); // Ambil semua data kegiatan
        return view('kegiatan.index',compact('kegiatans'));
    }
}
