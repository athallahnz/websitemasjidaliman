<?php

use App\Models\Kegiatan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\AdminKegiatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JadwalsholatController;
use App\Http\Controllers\HomeuserController;
use App\Http\Controllers\KajianController;
use App\Http\Controllers\UserKajianController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\BidangPendidikanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully.';
});

// Authentication Routes
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});
// Landing Page Route (Accessible by Guests)
Route::get('/', [GuestController::class, 'index'])->name('welcome');

// Infaq Routes (Accessible by Authenticated Users - Admin & User)
Route::middleware(['auth'])->group(function () {
    Route::get('/infaq/create', [HomeuserController::class, 'create'])->name('home.create');
    Route::post('/infaq/store', [HomeuserController::class, 'store'])->name('home.store');
});

// Admin Routes (Requires Admin Role)
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/testadmin', function () {
        return 'Welcome Admin';
    });

    // Admin Home (Jamaah Management)
    Route::get('/home', [JamaahController::class, 'index'])->name('home'); // Admin dashboard
    Route::get('/jamaah', [JamaahController::class, 'getData'])->name('jamaah.index'); // DataTables for Jamaah

    // Infaq Routes (Admin)
    Route::get('/jamaah/{id}', [JamaahController::class, 'show'])->name('infaq.show');
    Route::get('/jamaah/{id}/edit', [JamaahController::class, 'edit'])->name('infaq.edit');
    Route::put('/jamaah/{id}', [JamaahController::class, 'update'])->name('infaq.update');
    Route::delete('/jamaah/{id}', [JamaahController::class, 'destroy'])->name('infaq.destroy');

    // Route CRUD Slideshow
    Route::resource('slideshow', SlideshowController::class);

    Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('kegiatan', AdminKegiatanController::class)->names('admin.kegiatan');
        Route::resource('kategoris', KategoriController::class);
    });
});

// User Routes (Requires User Role)
Route::group(['middleware' => ['role:user']], function () {
    Route::get('/testuser', function () {
        return 'Welcome User';
    });

    // User Infaq Routes
    Route::get('/infaqku', [HomeuserController::class, 'index'])->name('infaqku');
    Route::get('/homeuser/infaq/{id}', [HomeuserController::class, 'show'])->name('homeuser.infaq.show');
    Route::get('/homeuser/infaq/{id}/edit', [HomeuserController::class, 'edit'])->name('homeuser.infaq.edit');
    Route::put('/homeuser/infaq/{id}', [HomeuserController::class, 'update'])->name('homeuser.infaq.update');
    Route::delete('/homeuser/infaq/{id}', [HomeuserController::class, 'destroy'])->name('homeuser.infaq.destroy');

    // Store Infaq for Users
    Route::post('/infaqku/store', [HomeuserController::class, 'store'])->name('infaqku.store');
});

// Redirect route for role-based home redirection
Route::get('/redirect', [HomeuserController::class, 'redirectToHome'])->name('redirectToHome');

// Prayer Schedule Routes (Accessible by Authenticated Users)
Route::get('/sholat/jadwal', [JadwalsholatController::class, 'showForm'])->name('sholat.form');
Route::post('/sholat/jadwal', [JadwalsholatController::class, 'getJadwalSholat'])->name('sholat.result');

// Kajian Routes (Accessible by All Authenticated Users)
Route::resource('kajians', KajianController::class);
Route::post('/ustadzs/store', [KajianController::class, 'storeUstadz'])->name('ustadzs.store');

// User Kajian Routes (View Kajian for Users)
Route::get('user/kajians', [UserKajianController::class, 'index'])->name('user.kajians.index');
Route::get('user/kajians/{kajian}', [UserKajianController::class, 'show'])->name('user.kajians.show');

// Feedback Routes (Accessible by All Authenticated Users)
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'send'])->name('feedback.send');


Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');

Route::get('/konsultasi', function () {
    return view('konsultasi');
});

// Bidang Pendidikan
Route::get('/pendidikan', [BidangPendidikanController::class, 'index'])->name('pendidikan');

// Tambahkan prefix group untuk mempermudah, misalnya 'pendidikan'
Route::prefix('pendidikan')->name('pendidikan.')->group(function () {

    // Rute TENTANG KAMI (about_us)
    // URL yang unik: tentang-kami/index, tentang-kami/visi-misi, dst.
    Route::get('tentang-kami', function () {
        return view('bidang_pendidikan.about_us.index');
    })->name('about_us.index');

    Route::get('tentang-kami/visi-misi', function () {
        return view('bidang_pendidikan.about_us.vision');
    })->name('about_us.vision');

    Route::get('tentang-kami/fasilitas', function () {
        return view('bidang_pendidikan.about_us.facility');
    })->name('about_us.facility');

    Route::get('tentang-kami/guru-staff', function () {
        return view('bidang_pendidikan.about_us.staff');
    })->name('about_us.staff');

    // ----------------------------------------------------------------------
    // Rute PROGRAM (Sekarang menggunakan URL unik)
    // ----------------------------------------------------------------------
    Route::get('program', function () {
        return view('bidang_pendidikan.program.index');
    })->name('program.index'); // Program Utama

    Route::get('program/tpq', function () { // URL: /pendidikan/program/tpq
        return view('bidang_pendidikan.program.tpq');
    })->name('program.tpq');

    Route::get('program/daycare', function () { // URL: /pendidikan/program/daycare
        return view('bidang_pendidikan.program.daycare');
    })->name('program.daycare');

    Route::get('program/kelompok-bermain', function () { // URL: /pendidikan/program/kelompok-bermain
        return view('bidang_pendidikan.program.kb');
    })->name('program.kb');

    Route::get('program/taman-kanak-kanak', function () { // URL: /pendidikan/program/taman-kanak-kanak
        return view('bidang_pendidikan.program.tk');
    })->name('program.tk');

    // ----------------------------------------------------------------------
    // Rute PENDAFTARAN (Sekarang menggunakan URL unik)
    // ----------------------------------------------------------------------
    Route::get('pendaftaran', function () {
        return view('bidang_pendidikan.registration.index');
    })->name('registration.index'); // Pendaftaran Utama

    Route::get('pendaftaran/prosedur', function () { // URL: /pendidikan/pendaftaran/prosedur
        return view('bidang_pendidikan.registration.procedure');
    })->name('registration.procedure');

    Route::get('pendaftaran/online', function () { // Tambahkan rute untuk "Pendaftaran Online"
        return view('bidang_pendidikan.registration.online'); // Perlu buat file Blade ini
    })->name('registration.online');

    Route::get('pendaftaran/info-selengkapnya', function () { // URL: /pendidikan/pendaftaran/info-selengkapnya
        return view('bidang_pendidikan.registration.info');
    })->name('registration.info');

    // ----------------------------------------------------------------------
    // Rute UNTUK ORANG TUA (Sekarang menggunakan URL unik)
    // ----------------------------------------------------------------------
    Route::get('orang-tua', function () {
        return view('bidang_pendidikan.for_parent.index');
    })->name('for_parent.index'); // Orang Tua Utama

    Route::get('orang-tua/proteksi-anak', function () { // URL: /pendidikan/orang-tua/proteksi-anak
        return view('bidang_pendidikan.for_parent.protection');
    })->name('for_parent.protection');

    Route::get('orang-tua/saran-masukan', function () { // URL: /pendidikan/orang-tua/saran-masukan
        return view('bidang_pendidikan.for_parent.feedback');
    })->name('for_parent.feedback');

    // ----------------------------------------------------------------------
    // Rute Non-Dropdown
    // ----------------------------------------------------------------------

    // Rute BERITA
    Route::get('berita', function () {
        return view('bidang_pendidikan.news.index');
    })->name('news.index');

    // Rute KONTAK
    Route::get('kontak', function () {
        return view('bidang_pendidikan.contact.index');
    })->name('contact.index');
});
