<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Jamaah;
use App\Models\Infaq;
use App\Models\Kajian;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class JamaahController extends Controller
{
    public function welcome(Request $request)
    {
        $search = $request->query('search');

        // Fetch Jamaahs with joined Infaqs
        $query = DB::table('jamaahs')
            ->join('infaqs', 'jamaahs.infaq_id', '=', 'infaqs.id')
            ->select('jamaahs.*', 'infaqs.name as infaq_name');

        if ($search) {
            $query->where('jamaahs.nama', 'like', '%' . $search . '%');
        }

        $jamaahs = $query->get();

        // Fetch Infaqs
        $infaqs = Infaq::all();

        // Fetch Kajian data
        $nextKajian = Kajian::where('start_time', '>', now())->orderBy('start_time')->first();

        // Example of fetching prayer schedule data
        $defaultCityId = 1638;
        $jadwalDefault = app('App\Http\Controllers\JadwalsholatController')->getJadwalSholat($defaultCityId);

        return view('welcome', compact('jamaahs', 'infaqs', 'jadwalDefault', 'search', 'nextKajian'));
    }


    public function index(Request $request, JadwalsholatController $jadwalsholatController)
    {
        // This method is for the main view
        $defaultCityId = 1638; // ID kota Surabaya
        $jadwalDefault = $jadwalsholatController->getJadwalSholat($defaultCityId);

        return view('home', compact('jadwalDefault'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('jamaahs')
                ->join('infaqs', 'jamaahs.infaq_id', '=', 'infaqs.id')
                ->select('jamaahs.*', 'infaqs.name as infaq_name');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <div class="d-flex gap-2">
                            <a href="' . route('infaq.show', $row->id) . '" class="btn btn-outline-dark btn-sm" title="View">
                                <i class="bi bi-person-lines-fill"></i>
                            </a>
                            <a href="' . route('infaq.edit', $row->id) . '" class="btn btn-outline-primary btn-sm" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="' . route('infaq.destroy', $row->id) . '" method="POST" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, JadwalsholatController $jadwalsholatController)
    {
        $searchCity = $request->query('search_city');

        // RAW SQL Query for fetching infaqs
        $infaqsQuery = DB::table('infaqs');

        // Apply search filter if search term is provided
        if ($searchCity) {
            $infaqsQuery->where('name', 'like', '%' . $searchCity . '%');
        }

        $infaqs = $infaqsQuery->get();

        // Example of fetching prayer schedule data
        $defaultCityId = 1638; // ID kota Surabaya
        $jadwalDefault = $jadwalsholatController->getJadwalSholat($defaultCityId);

        $nextKajian = Kajian::where('start_time', '>', now())->orderBy('start_time')->first();

        return view('welcome', compact('infaqs', 'jadwalDefault', 'searchCity', 'nextKajian'));
    }

    /**
     * Store a newly created resource in storage.
     */
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


    public function show(string $id)
    {
        // ELOQUENT
        $jamaahs = Jamaah::find($id);
        return view('infaq.show', compact('jamaahs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the Jamaah record by ID
        $jamaah = Jamaah::findOrFail($id);

        // Get all infaq categories for the dropdown
        $infaqs = Infaq::all();

        // Pass the data to the edit view
        return view('infaq.edit', compact('jamaah', 'infaqs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jamaah = Jamaah::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'nominal' => 'required|numeric',
            'infaq_id' => 'required|exists:infaq_categories,id', // Sesuaikan nama kolom
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Validasi file
        ]);

        // Jika ada file baru, hapus file lama dan simpan file baru
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($jamaah->file_path && file_exists(storage_path('app/public/' . $jamaah->file_path))) {
                unlink(storage_path('app/public/' . $jamaah->file_path));
            }

            // Simpan file baru
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/jamaah', $fileName, 'public');

            // Simpan data file baru
            $validatedData['file_path'] = $path;
            $validatedData['original_filename'] = $file->getClientOriginalName();
            $validatedData['encrypted_filename'] = $fileName;
        }

        // Update data jamaah
        $jamaah->update($validatedData);

        $validatedData['updated_at'] = Carbon::now();

        return redirect()->back()->with('success', 'Data jamaah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT: Find the record by ID
        $jamaah = Jamaah::find($id);

        // Check if the record exists
        if ($jamaah) {
            $jamaah->delete(); // Delete the record if found
            Alert::success('Deleted Successfully', 'Infaq Deleted Successfully.');
        } else {
            // Handle the case where the record is not found
            Alert::error('Deletion Failed', 'Infaq not found.');
        }

        return redirect()->route('home'); // Redirect back to the desired route
    }
}
