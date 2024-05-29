<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Auth;

class MasyarakatController extends Controller
{
     public function dashboard()
    {
        // Ambil data submission yang sesuai dengan akun masyarakat yang sedang login
        $submissions = Auth::user()->submissions;

        return view('masyarakat.dashboard', compact('submissions'));
    }

    public function file($id)
    {
        // Ambil data submission berdasarkan ID
        $submission = Submission::findOrFail($id);
    
        // Lalu kembalikan view atau lakukan aksi lainnya
        return view('submissions.file', ['submission' => $submission]);
    }
}
