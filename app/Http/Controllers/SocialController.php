<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Jika pengguna sudah ada di database, login
                Auth::login($user);
            } else {
                // Jika pengguna belum ada, buat pengguna baru dan simpan ke database
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'avatar' => $googleUser->avatar,
                    'role' => 'masyarakat', // Atur peran default, jika diperlukan
                    'password' => bcrypt(Str::random(24)), // Atur password acak karena tidak digunakan untuk login
                    'email_verified_at' => now(), // Set email sebagai sudah diverifikasi
                ]);
                Auth::login($user);
            }

            // Arahkan pengguna ke halaman submissions setelah login
            toast('Berhasil Login', 'success');
            return redirect()->intended('/submissions');
        } catch (\Exception $e) {

            alert()->error('Gagal Login', 'Coba Lagi');
            return redirect()->route('login')->withErrors(['error' => 'Terjadi kesalahan saat login dengan Google.']);
        }
    }
}
