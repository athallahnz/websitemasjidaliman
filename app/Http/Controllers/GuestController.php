<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Jamaah;
use App\Models\Infaq;
use App\Models\Kajian;
use App\Models\Slideshow;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use carbon\Carbon;

class GuestController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::all();
        $nextKajian = Kajian::where('start_time', '>', now())->orderBy('start_time')->first();
        $defaultCityId = 1638;
        $jadwalDefault = app('App\Http\Controllers\JadwalsholatController')->getJadwalSholat($defaultCityId);
        $recentJamaah = Jamaah::orderBy('id', 'desc')->take(5)->get();
        $totalInfaq = Jamaah::sum('nominal');
        $infaqs = Infaq::all();
        $lastUpdate = Jamaah::latest('updated_at')->value('updated_at') ?? Jamaah::latest('created_at')->value('created_at');
        return view('welcome', compact('nextKajian', 'jadwalDefault', 'recentJamaah', 'totalInfaq', 'infaqs', 'lastUpdate', 'slideshows'));
    }

    public function create()
    {
        $infaqs = Infaq::all();
        return view('infaq.create', compact('infaqs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'nominal' => 'required|numeric',
            'infaq_id' => 'required|exists:infaqs,id', // Sesuaikan nama tabel yang benar
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Validasi file
            'created_at' => 'Carbon::now();',
            'updated_at' => 'Carbon::now();',
        ]);
        // Tambahkan timestamp secara manual
        $validatedData['created_at'] = Carbon::now();
        $validatedData['updated_at'] = Carbon::now();

        // Jika ada file, simpan ke storage
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/jamaah', $fileName, 'public');

            $validatedData['file_path'] = $path;
            $validatedData['original_filename'] = $file->getClientOriginalName();
            $validatedData['encrypted_filename'] = $fileName;
        }

        Jamaah::create($validatedData);
        dd($validatedData);
        return redirect()->back()->with('success', 'Infaq berhasil disimpan');
    }

}
