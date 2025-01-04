<?php

namespace App\Http\Controllers;

use App\Models\Slideshow;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    // Menampilkan daftar slide
        public function index()
    {
        $slideshows = Slideshow::all();
        return view('admin.slideshows.index', compact('slideshows'));
    }

    // Menampilkan form tambah slide
    public function create()
    {
        return view('admin.slideshows.create');
    }

    // Menyimpan data slide baru
    public function store(Request $request)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Ambil semua input
    $input = $request->all();

    // Proses upload gambar jika ada
    if ($image = $request->file('image')) {
        $destinationPath = 'images/'; // Folder tujuan
        $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        $input['image'] = "$imageName";
    }

    // Simpan data slideshow
    Slideshow::create($input);

    // Tampilkan notifikasi sukses
    Alert::success('Success', 'Slide berhasil ditambahkan.');

    // Redirect ke halaman index slideshow
    return redirect()->route('slideshow.index');
}


    // Menampilkan form edit
    public function edit(Slideshow $slideshow)
    {
        return view('admin.slideshows.edit', compact('slideshow'));
    }

    // Menyimpan perubahan slide
    public function update(Request $request, Slideshow $slideshow)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slideshows', 'public');
            $slideshow->image = $imagePath;
        }

        $slideshow->title = $request->title;
        $slideshow->description = $request->description;
        $slideshow->save();

        return redirect()->route('slideshow.index')->with('success', 'Slide berhasil diperbarui.');
    }

    // Menghapus slide
    public function destroy(Slideshow $slideshow)
    {
        $slideshow->delete();
        return redirect()->route('slideshow.index')->with('success', 'Slide berhasil dihapus.');
    }
}
