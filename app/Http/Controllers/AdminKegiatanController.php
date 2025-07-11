<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;

class AdminKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.kegiatan.create', compact('kategoris'));
    }

    // Menyimpan data kegiatan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal_kegiatan' => 'required|date',
            'link' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        try {
            $kegiatan = new Kegiatan();
            $kegiatan->judul = $request->judul;
            $kegiatan->deskripsi = $request->deskripsi;
            $kegiatan->kategori_id = $request->kategori_id;
            $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
            $kegiatan->link = $request->link;

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('kegiatan', 'public');
                $kegiatan->gambar = $path;
            }

            $kegiatan->save();

            return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:kajian,santunan,pembangunan,ramadhan',
            'tanggal_kegiatan' => 'required|date',
            'link' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->judul = $request->judul;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->kategori = $request->kategori; // Simpan kategori manual
        $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
        $kegiatan->link = $request->link;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kegiatan', 'public');
            $kegiatan->gambar = $path;
        }

        $kegiatan->save();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar) {
            Storage::delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
