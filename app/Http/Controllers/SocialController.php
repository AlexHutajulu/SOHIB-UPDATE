<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Hash;
use App\Models\Submission;

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
                    'password' => Hash::make(Str::random(24)), // Atur password acak karena tidak digunakan untuk login
                    'email_verified_at' => now(), // Set email sebagai sudah diverifikasi
                ]);
                Auth::login($user);
            }

            // Periksa peran pengguna dan arahkan ke halaman yang sesuai
            if ($user->role == 'admin') {
                toast('Berhasil Login sebagai Admin', 'success');

                // Dapatkan semua submission dengan status 'diketahui' atau 'diterima'
                $submissions = Submission::whereIn('status', ['diketahui', 'diterima'])->get();

                // Jika ada submission dengan status yang sesuai, tampilkan toast jumlahnya
                if ($submissions->count() > 0) {
                    toast('Jumlah Permohonan dengan Status Diketahui atau Diterima: ' . $submissions->count(), 'info');
                } else {
                    toast('Tidak ada permohonan dengan status diketahui atau diterima.', 'info');
                }

                // Redirect ke rute 'admin.new'
                return redirect()->route('admin.new');
            } elseif ($user->role == 'kelurahan') {
                // Mengambil submissions dengan status 'proses'
                $submissions = Submission::where('status', 'proses')->get();
            
                // Jika ada submission dengan status yang sesuai, tampilkan toast jumlahnya
                if ($submissions->count() > 0) {
                    toast('Jumlah Permohonan dengan Status Proses: ' . $submissions->count(), 'info');
                } else {
                    toast('Tidak ada permohonan dengan status "proses".', 'info');
                }
            
                // Menampilkan toast berhasil login sebagai kelurahan
                
                
                // Mengarahkan pengguna ke route 'kelurahan.index'
                return redirect()->route('kelurahan.index');
            
            
            } elseif ($user->role == 'pimpinan') {
                toast('Berhasil Login sebagai Pimpinan', 'success');

                // Dapatkan semua submission dengan status 'diterima'
                $submissions = Submission::where('status', 'disetujui')->get();

                // Jika ada submission dengan status yang sesuai, tampilkan toast jumlahnya
                if ($submissions->count() > 0) {
                    toast('Jumlah Permohonan dengan Status Disetujui: ' . $submissions->count(), 'info');
                } else {
                    toast('Tidak ada permohonan dengan status Disetujui.', 'info');
                }
                return redirect()->route('pimpinan.index');
            } elseif ($user->role == 'superadmin') {
                toast('Berhasil Login sebagai superadmin', 'success');
                return redirect()->route('superadmin.accounts.index');
            } else {
                $submission = Submission::where('user_id', $user->id)->first();
                $statusMessage = 'Status permohonan Anda: ' . ($submission ? $submission->status : 'Belum ada permohonan');

                // Toast untuk berhasil login
                toast('Berhasil Login.', 'success');

                // Toast untuk status permohonan
                if ($submission) {
                    toast('Status Permohonan Anda:  ' . $submission->status, 'info');
                } else {
                    toast('Belum ada permohonan.', 'info');
                }

                // Redirect sesuai keinginan setelah login
                return redirect()->intended('/submissions');
            }
        } catch (\Exception $e) {
            alert()->error('Gagal Login', 'Coba Lagi');
            return redirect()->route('login');
        }
    }
}
