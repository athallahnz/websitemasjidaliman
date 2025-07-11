<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Kategori;


class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::all(); // Ambil semua data kegiatan
        $kategoris = Kategori::all();
        return view('kegiatan.index',compact('kegiatans','kategoris'));
    }
}
