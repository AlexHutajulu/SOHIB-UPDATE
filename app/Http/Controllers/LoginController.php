<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('Login.Login-admin');
    }
    public function daftar(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'role' => 'masyarakat',
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $nikCredentials = ['nik' => $request->input('email'), 'password' => $request->input('password')];

        // Attempt login with email
        if (Auth::attempt($credentials)) {
            // Jika berhasil, periksa role
            Session::forget('sessions' . Auth::id());
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Jika role admin, arahkan ke halaman admin
                toast('Berhasil Login', 'success');
                return redirect()->intended('/admin/new');
            } else {
                // Jika role masyarakat, arahkan ke halaman submissions
                toast('Berhasil Login', 'success');
                return redirect()->intended('/submissions');
            }
        }

        // Attempt login with NIK
        if (Auth::attempt($nikCredentials)) {
            // Jika berhasil, alihkan ke halaman submissions
            toast('Berhasil Login', 'success');
            return redirect()->intended('/submissions');
        }

        // Jika kedua upaya gagal, kembalikan dengan pesan kesalahan
        alert()->error('Login Gagal', 'Silahkan Coba Lagi');

        return redirect('/login');
    }

    public function googlelogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $nikCredentials = ['nik' => $request->input('email'), 'password' => $request->input('password')];

        // Attempt login with email
        if (Auth::attempt($credentials)) {
            // Jika berhasil, periksa role
            Session::forget('sessions' . Auth::id());
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Jika role admin, arahkan ke halaman admin
                return redirect()->intended('/admin/new');
            } else {
                // Jika role masyarakat, arahkan ke halaman submissions
                return redirect()->intended('/submissions');
            }
        }

        // Attempt login with NIK
        if (Auth::attempt($nikCredentials)) {
            // Jika berhasil, alihkan ke halaman submissions
            return redirect()->intended('/submissions');
        }

        // Jika kedua upaya gagal, kembalikan dengan pesan kesalahan
        return redirect('/login')->with('error', 'NIK atau Email dan Password Anda salah!');
    }

    public function logout()
    {
        $userId = auth()->id();
        Auth::logout();
        Session::forget('sessions' . $userId); // Sesuaikan dengan prefix sesi yang sesuai

        toast('Berhasil Logout', 'success');
        return redirect('/login');
    }
}
