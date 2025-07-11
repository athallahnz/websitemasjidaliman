<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Correct namespace for handling HTTP requests
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        // Validasi Input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|min:8',
        ]);
        
        $login = $request->input('email');

        // Cek apakah input berupa email atau nomor
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $login)->first();
        } elseif (preg_match('/^[0-9]+$/', $login)) {
            $user = User::where('nomor', $login)->first();
        } else {
            Alert::error('Login Gagal', 'Format email atau nomor tidak valid!');
            return redirect()->back()->withErrors(['email' => 'Format email atau nomor salah'])->withInput();
        }

        // Jika user tidak ditemukan
        if (!$user) {
            Alert::error('Login Gagal', 'Email atau nomor tidak terdaftar!');
            return redirect()->back()->withErrors(['email' => 'Email atau nomor tidak ditemukan'])->withInput();
        }

        // Coba login dengan email atau nomor
        if (
            Auth::attempt(['email' => $user->email, 'password' => $request->password]) ||
            Auth::attempt(['nomor' => $user->nomor, 'password' => $request->password])
        ) {

            Alert::success('Login Berhasil', 'Selamat datang, ' . $user->name . '!');
            return redirect('/');
        }

        // Jika password salah
        Alert::error('Login Gagal', 'Password salah!');
        return redirect()->back()->withErrors(['password' => 'Password yang dimasukkan salah'])->withInput();
    }
}
